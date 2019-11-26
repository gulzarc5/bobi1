<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Session;
use DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password,'status' => '1'])) {
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                if (count($cart) > 0) {
                    foreach ($cart as $book_id => $value) {
                    $check_cart_product = DB::table('cart')
                        ->where('book_id',$book_id)
                        ->where('user_id',Auth::guard('buyer')->user()->id)
                        ->count();
                    if ($check_cart_product < 1 ) {
                        DB::table('cart')
                            ->insert([
                            'book_id' =>  $book_id,
                            'user_id' => Auth::guard('buyer')->user()->id,
                            'quantity' => $value['quantity'],
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);
                    }
                    }
                }
                Session::forget('cart');
                Session::save();
            }

            if (Auth::guard('buyer')->user()->membership_status == '2') {
                $expiry_date = Auth::guard('buyer')->user()->membership_expiry;
                $expiry_date_time = Carbon::createFromDate($expiry_date , 'Asia/Kolkata');
                $today = $new_expiry_date_time = Carbon::now('Asia/Kolkata');
                if ($expiry_date_time->lessThan($today)) {
                    DB::table('users')
                        ->where('id',Auth::guard('buyer')->user()->id)
                        ->update([
                            'membership_status' => 1,
                        ]);
                }
            }
            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }

    public function logout()
    {
        Auth::guard('buyer')->logout();
        return redirect()->route('web.user_login');
    }
}
