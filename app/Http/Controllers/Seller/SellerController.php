<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;
use DB;
use Auth;
use Carbon\Carbon;

class SellerController extends Controller
{
    // Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

    public function sellerLoginForm()
    {
        return view('web.seller-login');
        
    }
    
    public function index(){
        $seller_id = Auth::guard('seller')->user()->id;
        $last_ten_orders = DB::table('book_order_details')
            ->select('book_order_details.*','users.name as u_name','book_orders.payment_status as payment_status','book_orders.payment_method as payment_method')
            ->leftjoin('users','users.id','=','book_order_details.user_id')
            ->leftjoin('book_orders','book_orders.id','=','book_order_details.order_id')
            ->where('book_order_details.seller_id',$seller_id)
            ->orderBy('book_order_details.id','desc')
            ->limit(10)
            ->get();
        $book_count = DB::table('books')->where('user_id',$seller_id)->whereNull('deleted_at')->count();
        $project_count = DB::table('projects')->where('user_id',$seller_id)->whereNull('deleted_at')->count();
        $megazine_count = DB::table('megazines')->where('user_id',$seller_id)->whereNull('deleted_at')->count();
        $book_order_count = DB::table('book_order_details')->where('seller_id',$seller_id)->count();
        $project_order_count = DB::table('project_orders')->where('seller_id',$seller_id)->count();
        $megazine_order_count = DB::table('megazine_orders')->where('seller_id',$seller_id)->count();
        $deshboard_data = [
            'last_ten_orders' => $last_ten_orders,
            'book_count' => $book_count,
            'project_count' => $project_count,
            'megazine_count' => $megazine_count,
            'book_order_count' => $book_order_count,
            'project_order_count' => $project_order_count,
            'megazine_order_count' => $megazine_order_count,

        ];
        return view('seller.seller_deshboard',compact('deshboard_data'));
    }

    public function myProfileForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = DB::table('users')
        ->where('id',$seller_id)
        ->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();

        $city = null;
        if (!empty($seller->state_id)) {
            $city = DB::table('city')
            ->where('state_id',$seller->state_id)
            ->get();
        }
        $seller_bank = DB::table('seller_bank_account')
            ->whereNull('deleted_at')
            ->where('user_id',$seller_id)
            ->first();
        return view('seller.profile.myprofile',compact('seller','state','city','seller_bank'));
    }

    public function sellerUpdate(Request $request)
    {
        $seller_id = Auth::guard('seller')->user()->id;

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'pan' => 'required',
            'gender' => 'required',
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $seller = DB::table('users')
        ->where('id',$seller_id)
        ->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
            'pan' => $request->input('pan'),
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'pin' => $request->input('pin'),     
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        $seller_details = DB::table('seller_bank_account')
        ->where('user_id',$seller_id)
        ->update([
            'bank_name' => $request->input('bank_name'),
            'branch_name' => $request->input('branch_name'),
            'account_no' => $request->input('account_no'),
            'ifsc' => $request->input('ifsc'),
            'upi_name' => $request->input('upi_name'),
            'upi_id' => $request->input('upi_id'),
            'upi_mobile' => $request->input('upi_mobile'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        return redirect()->back();

    }

    public function viewChangePasswordForm()
    {
        return view('seller.profile.change_password');
    }

    public function ChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('seller')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('seller')->user()->id; 
            $password_change = DB::table('users')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            return redirect()->back()->with('message','Profile Updated Successfully');
            
        }else{           
            return redirect()->back()->with('error','Something Wrong With Update');
       }
    }
    
    public function myCategoryForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $dealing_category = DB::table('seller_deals')->where('user_id',$seller_id)->first();
        
        return view('seller.profile.my_category',compact('dealing_category'));
    }

    public function myCategoryUpdate(Request $request)
    {
        $validatedData = $request->validate([
            "deal_cat"    => "required|array|min:1",
            "deal_cat.*"  => "required|distinct|min:1",
        ]);
        $flag = false;
        $deal_category = $request->input('deal_cat'); // deal category array 
        $user_id = Auth::guard('seller')->user()->id; 
        $book = 1;
        $project = 1;
        $megazine = 1;
        $quiz = 1;

        foreach ($deal_category as $key => $value) {
            if (!empty( $value)) {
                if ($value == '1') {
                    $book = 2;
                } elseif ($value == '2') {
                    $project = 2;
                }elseif ($value == '3') {
                    $megazine = 2;
                }elseif ($value == '4'){
                    $quiz = 2;
                }
               
            }
        }
        $seller = DB::table('seller_deals')
            ->where('user_id',$user_id)
            ->update([
                'project' => $project,
                'book' => $book,
                'megazine' => $megazine,
                'quiz' => $quiz,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }
}
