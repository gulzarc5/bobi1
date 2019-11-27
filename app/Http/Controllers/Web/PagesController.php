<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\Mail\OrderMail;
use Mail;
use Auth;


class PagesController extends Controller
{
    public function signUpForm()
    {
        return view('web.register');
    }

    public function userLoginForm()
    {
        return view('web.login');
    }

    public function forgotPasswordForm()
    {
        return view('web.forgot-password');
    }

    public function indexPage()
    {
        $new_books = DB::table('books')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('approve_status',1)
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        return view('web.home',compact('new_books'));
    }

    public function contactUs()
    {
        return view('web.thankyou.contact');
    }

    public function contactUsSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $request_info = urldecode("<table>
            <tr>
                <td>Name : </td>
                <td>".$request->input('name')."</td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>".$request->input('email')."</td>
            </tr>
            <tr>
                <td>Subject : </td>
                <td>".$request->input('subject')."</td>
            </tr>
            <tr>
                <td>Message : </td>
                <td>".$request->input('message')."</td>
            </tr>
        </table>");
        $subject = "Edujiyaan Book Order";
        $data = [
            'message' => $request_info,
            'subject' => $request->input('subject'),
        ];
        Mail::to("gulzarc5@gmail.com")->send(new OrderMail($data));
        return redirect()->back()->with('message','Thanks For The Query We Get Back To You Soon');
    }

    public function becomeSellerForm()
    {
        $user_id = Auth::guard('buyer')->id();
        $user = DB::table('users')->where('id',$user_id)->first();

        return view('web.seller-signup',compact('user'));
    }    
}
