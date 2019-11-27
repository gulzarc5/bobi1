<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminDeshboardController extends Controller
{
    public function index(){
        $seller_count = DB::table('users')
            ->where('user_role',2)
            ->whereNull('deleted_at')
            ->count();
        $buyer_count = DB::table('users')
            ->where('user_role',2)
            ->whereNull('deleted_at')
            ->count();
        $books_count = DB::table('books')
            ->whereNull('deleted_at')
            ->count();
        $projectss_count = DB::table('projects')
            ->whereNull('deleted_at')
            ->count();
        $megazine_count = DB::table('megazines')
            ->whereNull('deleted_at')
            ->count();
        $quiz_count = DB::table('quiz')
            ->whereNull('deleted_at')
            ->count();
        $last_seller = DB::table('users')
            ->where('user_role',2)
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->limit(10)->get();
    	return view('admin.admindeshboard',compact('last_seller','seller_count','buyer_count','books_count','projectss_count','megazine_count','quiz_count'));
    }

    public function changePasswordAdmin()
    {
        return view('admin.change_password');
    }

    public function changePasswordAdminSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6', 'same:new_password'],
        ]);

        $current_password = Auth::guard('admin')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('admin')->user()->id; 
            $password_change = DB::table('admin')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            return redirect()->back()->with('message','Password Changed Successfully');
            
        }else{           
            return redirect()->back()->with('error','Current Password Does Not Matched');
       }
    }
}
