<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{

    public function viewCart()
    {
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $cart_data =[];
            $user_id = Auth::guard('buyer')->user()->id;

            $cart = DB::table('cart')->where('user_id',$user_id)->get();
            if (count($cart) > 0) {
                foreach ($cart as $key => $item) {
                    $cart = DB::table('books')->where('id',$item->book_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();
                        $cart->quantity = $item->quantity;
                        $cart_data[] =$cart;
                }
            }else{
                $cart_data = false;
            }
            return view('web.cart',compact('cart_data'));
        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart_data =[];

                if (count($cart) > 0) {
                    foreach ($cart as $product_id => $value) {
                        $cart = DB::table('books')->where('id',$product_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();
                        $cart->quantity = $value['quantity'];
                        $cart_data[] =$cart;
                    }
                }else{
                    $cart_data = false;
                }
            }else{
                $cart_data = false;
            }
            // dd($cart_data);
            return view('web.cart',compact('cart_data'));
        }
         
    }
    public function AddCart($book_id)
    {
        //*********************if user is logged in*********************
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            try {
                $book_id = decrypt($book_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }

            $user_id = Auth::guard('buyer')->user()->id;

            // Check This Product Is already Exist in Cart Or Not
            $check_cart_product = DB::table('cart')
                ->where('book_id',$book_id)
                ->where('user_id',$user_id)
                ->count();

            if ($check_cart_product) {
                if ($check_cart_product > 0 ) {
                    return redirect()->route('web.viewCart');
                }
            }

            $cart_insert = DB::table('cart')
                ->insert([
                'book_id' =>  $book_id,
                'user_id' => Auth::guard('buyer')->user()->id,
                'quantity' => 1,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
             return redirect()->route('web.viewCart');
        }else{
            //***************If Guest User***************
            // Session::forget('cart');
            try {
                $book_id = decrypt($book_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart[$book_id] =[
                     'quantity' => 1,
                 ];
            }else{
                $cart = [$book_id => [
                     'quantity' => 1,
                    ],
                ];
            }
            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart');
        }
    }
    
    public function cartItemRemove($book_id)
    {
        try{
            $book_id = decrypt($book_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;
            $delete_cart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('book_id',$book_id)
            ->delete();
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            Session::forget('cart.'.$book_id);
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }
    }

    public function updateCart(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'quantity' => ['required', 'numeric'],
        ]);

        $book_id = $request->input('book_id');
        $quantity = $request->input('quantity');

        try{
            $book_id = decrypt($book_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        //**********Minimum Order Quantity Check**************
        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;

            $updateCart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('book_id',$book_id)
            ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            $cart = Session::get('cart');
            $item = $cart[$book_id]['quantity'] = $quantity;

            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }

    }

}
