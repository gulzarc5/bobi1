<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use App\Mail\OrderMail;
use Mail;
use  SmsHelpers;

class CheckoutController extends Controller
{
    public function CheckoutBook()
    {
        $user_id = Auth::guard('buyer')->user()->id;
        $shipping_address = DB::table('user_shipping_address')
        ->select('user_shipping_address.*','state.name as s_name','city.name as c_name')
        ->leftjoin('state','state.id','=','user_shipping_address.state_id')
        ->leftjoin('city','city.id','=','user_shipping_address.city_id')
        ->where('user_shipping_address.user_id',$user_id)
        ->whereNull('user_shipping_address.deleted_at')
        ->orderBy('user_shipping_address.id','desc')
        ->get();

        if ($shipping_address->count() > 0) {
            $cart = DB::table('cart')
                ->select(DB::raw('SUM(books.price) AS total_cart_amount'),DB::raw('SUM(cart.quantity) AS total_quantity'),DB::raw('SUM(books.shipping_charge) AS total_shipping_charge'))
                ->leftjoin('books','books.id','=','cart.book_id')
                ->where('cart.user_id',$user_id)
                ->first();
            // dd($cart);

            return view('web.checkout.checkout',compact('shipping_address','cart'));
        }else{
            $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
            return view('web.checkout.checkout-add-address',compact('states'));
        }
        
    }

    public function CheckoutAddAddress()
    {
        $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
        return view('web.checkout.checkout-add-address',compact('states'));
    }

    public function CheckoutInsertAddress(Request $request)
    {        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'email|required',
            'mobile' =>  ['required','digits:10','numeric'],
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);
        
        $user_id = Auth::guard('buyer')->user()->id;
        $shipping_add = DB::table('user_shipping_address')
            ->insert([
                'user_id' => $user_id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' =>  $request->input('mobile'),
                'pin' => $request->input('pin'),
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_add) {
            return redirect()->route('web.checkout_book')->with('message','Shipping Address Added Successfully');
        } else {
            return redirect()->back()->with('error','Sorry Something Went Wrong Please Try Again');
        }
    }

    public function bookOrderPlace(Request $request)
    {
        $validatedData = $request->validate([
            'shipping_id' => ['required', 'numeric'],
            'payment_method' => 'numeric|required',
        ]);

        $shipping_id = $request->input('shipping_id');
        $payment_method = $request->input('payment_method'); // value 1 = COD, 2 = Online
        $user_id = Auth::guard('buyer')->user()->id;
        $total_order_amount = 0;
        $total_shipping_charge = 0;
        $total_quantity = 0 ;
        $book_order = DB::table('book_orders')
            ->insertGetId([
                'user_id' => $user_id,
                'shipping_address_id' => $shipping_id,
                'payment_method' => $payment_method,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        $cart = DB::table('cart')
            ->where('user_id',$user_id)
            ->get();

        foreach ($cart as $key => $value) {
            $book = DB::table('books')->where('id',$value->book_id)
                ->first();
            if ($book) {
                $total_order_amount += $book->price*$value->quantity;
                $total_shipping_charge += $book->shipping_charge*$value->quantity;
                $total_quantity += $value->quantity ;
                DB::table('book_order_details')
                    ->insert([
                        'user_id' => $user_id,
                        'book_id' => $book->id,
                        'order_id' => $book_order,
                        'seller_id' => $book->user_id,
                        'shipping_address_id' => $shipping_id,
                        'rate' => $book->price,
                        'shipping_charge' => $book->shipping_charge,
                        'quantity' => $value->quantity,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);                    
            }
        }

        $book_order_update = DB::table('book_orders')
            ->where('id',$book_order)
            ->update([
                'total_quantity' => $total_quantity,
                'shipping_charge' => $total_shipping_charge,
                'total_amount' => $total_order_amount,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($payment_method == '1') {
            DB::table('cart')->where('user_id',$user_id)->delete();

            $user_id = Auth::guard('buyer')->user()->id;
            $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Order Has Been Placed Successfully We Wiill Deliver it Shortly. Thank You");
            $subject = "Edujiyaan Order Confirmation";
            $data = [
                'message' => $request_info,
                'subject' => $subject,
            ];
           
            
            Mail::to(Auth::guard('buyer')->user()->email)->send(new OrderMail($data));
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);
            $book_orders = DB::table('book_order_details')
                ->select('books.*')
                ->leftjoin('books','books.id','=','book_order_details.book_id')
                ->where('book_order_details.order_id',$book_order)
                ->get();
            
            if ($book_orders) {
                foreach ($book_orders as $key => $value) {
                    
                    if ($value->user_id != 'A') {
                       
                        $seller_id = $value->user_id;
                        $request_info = urldecode("Dear Seller, Your Book ".$value->book_name." Has Been Sold By A Customer Please Keep This Book Ready. And Deliver It By Tomorrow. Thank You");
                        $subject = "Edujiyaan Book Order";

                        $seller_email = DB::table('users')->where('id',$seller_id)->first();
                        $data = [
                            'message' => $request_info,
                            'subject' => $subject,
                        ];
                        Mail::to($seller_email->email)->send(new OrderMail($data));
                        SmsHelpers::smsSend($seller_email->mobile,$request_info);
                    }
                }
            }
            return redirect()->route('web.book_order_thanks',['order_id'=>encrypt($book_order),'payment_method'=>encrypt($payment_method)]);
        }else {
            DB::table('cart')->where('user_id',$user_id)->delete();
            $total_cost = $total_shipping_charge+$total_order_amount;
            $user_name = Auth::guard('buyer')->user()->name;
            $user_email = Auth::guard('buyer')->user()->email;
            $user_mobile = Auth::guard('buyer')->user()->mobile;
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );     
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Book Purchase Payment",
                    "amount" => $total_cost,
                    "buyer_name" => $user_name,
                    "send_email" => true,
                    "email" => $user_email,
                    "phone" => $user_mobile,
                    "redirect_url" => "http://127.0.0.1:8000/User/Checkout/Book/Online/Pay/Success/".encrypt($book_order)
                    ));
    
                    DB::table('book_orders')
                        ->where('id',$book_order)
                        ->update([
                            'payment_request_id' => $response['id'],
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                    
                    header('Location: ' . $response['longurl']);
                    exit();
            }catch (Exception $e) {
                print('Error: ' . $e->getMessage());
            }
        }
        
    }

    public function bookPaySuccess(Request $request,$order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        try {
    
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
     
            $response = $api->paymentRequestStatus(request('payment_request_id'));
     
            if( !isset($response['payments'][0]['status']) ) {
             return redirect('web.checkout_book');
            } else if($response['payments'][0]['status'] != 'Credit') {
             return redirect('web.checkout_book');
            } 
          }catch (\Exception $e) {
             return redirect('web.checkout_book');
         }
        
        if($response['payments'][0]['status'] == 'Credit') {
 
             $user_id = Auth::guard('buyer')->user()->id;
             DB::table('book_orders')
                     ->where('id', $order_id)
                     ->where('user_id', $user_id)
                     ->where('payment_request_id', $response['id'])
                     ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '1']);
            
            $user_id = Auth::guard('buyer')->user()->id;
            $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Order Has Been Placed Successfully We Wiill Deliver it Shortly. Thank You");
            $subject = "Edujiyaan Order Confirmation";
            $data = [
                'message' => $request_info,
                'subject' => $subject,
            ];
            Mail::to(Auth::guard('buyer')->user()->email)->send(new OrderMail($data));
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

            $book_orders = DB::table('book_order_details')
                ->select('books.*')
                ->leftjoin('books','books.id','=','book_order_details.book_id')
                ->where('book_order_details.order_id',$order_id)
                ->get();
            if ($book_orders) {
                foreach ($book_orders as $key => $value) {
                    if ($value->user_id != 'A') {
                        $seller_id = $value->user_id;
                        $request_info = urldecode("Dear Seller, Your Book ".$value->book_name." Has Been Sold By A Customer Please Keep This Book Ready. And Deliver It By Tomorrow. Thank You");
                        $subject = "Edujiyaan Book Order";

                        $seller_email = DB::table('users')->where('id',$seller_id)->first();
                        $data = [
                            'message' => $request_info,
                            'subject' => $subject,
                        ];
                        Mail::to($seller_email->email)->send(new OrderMail($data));
                        SmsHelpers::smsSend($seller_email->mobile,$request_info);
                    }
                }
            }
            
            return view('web.thankyou.book_thank');
        } 
    }
    public function bookOrderThanks( $order_id,$payment_method, $payment_id = null)
    {
        try {
            $order_id = decrypt($order_id);
            $payment_method = decrypt($payment_method);
            if (!empty($payment_id)) {
                $payment_id = decrypt($payment_id);
            }
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $data = [
            'order_id' => $order_id,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
        ];

        return view('web.thankyou.book_thank',compact('data'));
    }

    public function CheckoutProject($project_id)
    {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $project = DB::table('projects')
                        ->leftJoin('project_spalization', 'projects.specialization_id', '=', 'project_spalization.id')
                        ->select('projects.*', 'project_spalization.name as ps_name')
                        ->where('projects.id', $project_id)
                        ->get();
        
        return view('web.checkout.project-checkout', ['project' => $project]);
    }

    public function payProject($project_id){

        $project = DB::table('projects')
                        ->where('projects.id', $project_id)
                        ->get();

        $user_id = Auth::guard('buyer')->user()->id;
        $user_info = DB::table('users')
                        ->where('id', $user_id)
                        ->get();
 
        $api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
    
       try {
           $response = $api->paymentRequestCreate(array(
               "purpose" => "Project Payment",
               "amount" => $project[0]->cost,
               "buyer_name" => $project[0]->name,
               "send_email" => true,
               "email" => $user_info[0]->email,
               "phone" => $user_info[0]->mobile,
               "redirect_url" => "http://127.0.0.1:8000/User/Checkout/project/pay_success/".$project_id
               ));

               DB::table('project_orders')
                    ->insert([
                        'user_id'    => $user_id,
                        'project_id' => $project_id,
                        'seller_id'  => $project[0]->user_id,
                        'price'      => $project[0]->cost,
                        'payment_request_id' => $response['id'],
                        'payment_status' => 2,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                
               header('Location: ' . $response['longurl']);
               exit();
       }catch (Exception $e) {
           print('Error: ' . $e->getMessage());
       }      
    }

    public function successProject(Request $request, $project_id){
        try {
    
           $api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
    
           $response = $api->paymentRequestStatus(request('payment_request_id'));
    
           if( !isset($response['payments'][0]['status']) ) {
            return redirect('web.checkout_project', ['project_id' => $project_id]);
           } else if($response['payments'][0]['status'] != 'Credit') {
            return redirect('web.checkout_project', ['project_id' => $project_id]);
           } 
         }catch (\Exception $e) {
            return redirect('web.checkout_project', ['project_id' => $project_id]);
        }
       
        if($response['payments'][0]['status'] == 'Credit') {

            $user_id = Auth::guard('buyer')->user()->id;
            DB::table('project_orders')
                    ->where('project_id', $project_id)
                    ->where('user_id', $user_id)
                    ->where('payment_request_id', $response['id'])
                    ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '1']);

            /** Email Sending **/
            $project_data = DB::table('projects')
                ->where('id', $project_id)
                ->first();
            if($project_data->user_id != 'A') {

                $request_info = urldecode("Dear Seller, your project ".$project_data->name." has been sold by a customer with Rs.".number_format($project_data->cost).". Please ! check your panel. Thank You");
                $subject = "Edujiyaan Purchase Email";
                $data = [
                    'message' => $request_info,
                    'subject' => $subject,
                ];
                $seller = DB::table('users')->where('id', $project_data->user_id)->first();
                Mail::to($seller->email)->send(new OrderMail($data));
                SmsHelpers::smsSend($seller->mobile,$request_info);
            }

             $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", order of project ".$project_data->name." has been success, You can view or download the project file after login in edujiyaan. Thank You");
                $subject = "Edujiyaan Order Confirmation";
                $data = [
                    'message' => $request_info,
                    'subject' => $subject,
                ];
            Mail::to(Auth::guard('buyer')->user()->email)->send(new OrderMail($data));
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

           	return view('web.thankyou.project_thank');
       	} 
    }

    public function CheckoutMegazine($megazine_id)
    {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $megazine = DB::table('megazines')
                        ->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
                        ->select('megazines.*', 'magazine_category.name as m_name')
                        ->where('megazines.id', $megazine_id)
                        ->get();
        
        return view('web.checkout.megazine-checkout', ['megazine' => $megazine]);
    }

    public function payMegazine($megazine_id){

        $megazine = DB::table('megazines')
                        ->where('megazines.id', $megazine_id)
                        ->get();

        $user_id = Auth::guard('buyer')->user()->id;
        $user_info = DB::table('users')
                        ->where('id', $user_id)
                        ->get();
 
        $api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
    
       try {
           $response = $api->paymentRequestCreate(array(
               "purpose" => "Megazine Payment",
               "amount" => $megazine[0]->cost,
               "buyer_name" => $megazine[0]->name,
               "send_email" => true,
               "email" => $user_info[0]->email,
               "phone" => $user_info[0]->mobile,
               "redirect_url" => "http://127.0.0.1:8000/User/Checkout/megazine/pay_success/".$megazine_id
               ));

               DB::table('megazine_orders')
                    ->insert([
                        'user_id'    => $user_id,                        
                        'seller_id'  => $megazine[0]->user_id,
                        'megazine_id' => $megazine_id,
                        'price'      => $megazine[0]->cost,
                        'payment_request_id' => $response['id'],
                        'payment_status' => 2,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                
               header('Location: ' . $response['longurl']);
               exit();
       }catch (Exception $e) {
           print('Error: ' . $e->getMessage());
       }      
    }

    public function successMegazine(Request $request, $megazine_id){
        try {
    
           $api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
    
           $response = $api->paymentRequestStatus(request('payment_request_id'));
    
           if( !isset($response['payments'][0]['status']) ) {
            return redirect('web.checkout_megazine', ['megazine_id' => $megazine_id]);
           } else if($response['payments'][0]['status'] != 'Credit') {
            return redirect('web.checkout_megazine', ['megazine_id' => $megazine_id]);
           } 
         }catch (\Exception $e) {
            return redirect('web.checkout_megazine', ['megazine_id' => $megazine_id]);
        }
       
        if($response['payments'][0]['status'] == 'Credit') {

            $user_id = Auth::guard('buyer')->user()->id;
            DB::table('megazine_orders')
                    ->where('megazine_id', $megazine_id)
                    ->where('user_id', $user_id)
                    ->where('payment_request_id', $response['id'])
                    ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '1']);

            $megazine_data = DB::table('megazines')
                    ->where('id', $megazine_id)
                    ->first();
            if($megazine_data->user_id != 'A') {
                $request_info = urldecode("Dear Seller, your Megazine ".$megazine_data->name." has been sold by a customer with Rs.".number_format($megazine_data->cost).". Please ! check your seller panel. Thank You");
                $subject = "Edujiyaan Purchase Email";
                $data = [
                    'message' => $request_info,
                    'subject' => $subject,
                ];
                $seller = DB::table('users')->where('id', $megazine_data->user_id)->first();
                Mail::to($seller->email)->send(new OrderMail($data));
                SmsHelpers::smsSend($seller->mobile,$request_info);
            }

            $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", order of Megazine ".$megazine_data->name." has been success, You can view or download the Megazine file after login in edujiyaan. Thank You");
                $subject = "Edujiyaan Order Confirmation";
                $data = [
                    'message' => $request_info,
                    'subject' => $subject,
                ];
            Mail::to(Auth::guard('buyer')->user()->email)->send(new OrderMail($data));
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);
            return view('web.thankyou.megazine_thank');
        } 
    }
}
