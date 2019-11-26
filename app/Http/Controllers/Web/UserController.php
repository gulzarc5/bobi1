<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function myProfile()
    {
        $user_id = Auth::guard('buyer')->id();
        $user_details = DB::table('users')
            ->select('users.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','users.state_id')
            ->leftjoin('city','city.id','=','users.city_id')
            ->where('users.id',$user_id)
            ->first();

        return view('web.user.user-detail',compact('user_details'));
    }

    public function myProfileEdit()
    {
        $user_id = Auth::guard('buyer')->id();
        $user_details = DB::table('users')
            ->select('users.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','users.state_id')
            ->leftjoin('city','city.id','=','users.city_id')
            ->where('users.id',$user_id)
            ->first();
        
        $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
        $city = null;
            if (!empty($user_details->state_id)) {
                $city = DB::table('city')
                ->where('state_id',$user_details->state_id)
                ->get();
            }

        return view('web.user.add-user-addrs',compact('user_details','states','city'));
    }

    public function myProfileUpdate(Request $request)
    {
        $user_id = Auth::guard('buyer')->user()->id;

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'pan' => 'required',
            'gender' => 'required',
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);
        
        $user_update = DB::table('users')
            ->where('id',$user_id)
            ->update([
                'name' => $request->input('name'),
                'dob' => $request->input('dob'),
                'pan' => $request->input('pan'),
                'gender' => $request->input('gender'),
                'pin' => $request->input('pin'),
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($user_update) {
            return redirect()->route('web.myProfile')->with('message','Your Password Changed Successfully');
        } else {
            return redirect()->back()->with('error','Sorry Current Password Does Not matched');
        }
        

    }

    public function viewChangePasswordForm()
    {
        return view('web.user.change-password');
    }

    public function ChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('buyer')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('buyer')->user()->id; 
            $password_change = DB::table('users')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            return redirect()->back()->with('message','Your Password Changed Successfully');            
        }else{           
            return redirect()->back()->with('error','Sorry Current Password Does Not matched');
       }
    }

    public function viewShippingAddressList()
    {
        $user_id = Auth::guard('buyer')->id();
        $shipping_address = DB::table('user_shipping_address')
            ->select('user_shipping_address.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','user_shipping_address.state_id')
            ->leftjoin('city','city.id','=','user_shipping_address.city_id')
            ->where('user_shipping_address.user_id',$user_id)
            ->whereNull('user_shipping_address.deleted_at')
            ->get();
        if ($shipping_address->count() > 0) {
           
            return view('web.shipping-address.shipping-address',compact('shipping_address'));
        }else {
            $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
            return view('web.shipping-address.add-shipping-address',compact('states'));
        }       
        
    }

    public function viewShippingAddressForm()
    {
        $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
        return view('web.shipping-address.add-shipping-address',compact('states'));
    }

    public function ShippingAddressAdd(Request $request)
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
            return redirect()->route('web.view_shipping_address_list')->with('message','Shipping Address Added Successfully');
        } else {
            return redirect()->back()->with('error','Sorry Something Went Wrong Please Try Again');
        }
    }

    public function ShippingAddressDelete($shipping_id)
    {
        try {
            $shipping_id = decrypt($shipping_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('user_shipping_address')
            ->where('id',$shipping_id)
            ->update([
                'deleted_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Shipping Address Deleted Successfully');
    }

    public function ShippingAddressEdit($shipping_id)
    {
        try {
            $shipping_id = decrypt($shipping_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $shipping_address = DB::table('user_shipping_address')
            ->where('id',$shipping_id)
            ->whereNull('deleted_at')
            ->first();
        
        $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
        $city = null;
            if (!empty($shipping_address->state_id)) {
                $city = DB::table('city')
                ->where('state_id',$shipping_address->state_id)
                ->get();
            }
        return view('web.shipping-address.edit-shipping-address',compact('shipping_address','states','city'));
        
    }

    public function ShippingAddressUpdate(Request $request)
    {
        try {
            $shipping_id = decrypt($request->input('shipping_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'email|required',
            'mobile' =>  ['required','digits:10','numeric'],
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $shipping_update = DB::table('user_shipping_address')
            ->where('id',$shipping_id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' =>  $request->input('mobile'),
                'pin' => $request->input('pin'),
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_update) {
            return redirect()->route('web.view_shipping_address_list')->with('message','Shipping Address Updated Successfully');
        } else {
            return redirect()->back()->with('error','Sorry Something Went Wrong Please Try Again');
        }
    }
}
