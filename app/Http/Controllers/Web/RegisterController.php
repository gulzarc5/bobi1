<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use DB;

class RegisterController extends Controller
{
    public function userRegister(Request $request)
    {
        $validatedData = $request->validate([
            'user_role' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'mobile' =>  ['required','digits:10','numeric','unique:users'],
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_role' => $request->input('user_role'),
            'gender' => $request->input('gender'),
            'password' =>  Hash::make($request->input('password')),
        ]);
        if ($user) {
            if ($request->input('user_role') == '2') {
                $books = 1;
                $projects = 1;
                $megazine = 1;
                $quiz = 1;
                if ($request->has('book') && !empty($books)) {
                    $books = 2;
                }
                if ($request->has('project') && !empty($projects)) {
                    $projects = 2;
                }
                if ($request->has('megazine') && !empty($megazine)) {
                    $megazine = 2;
                }
                if ($request->has('quiz') && !empty($quiz)) {
                    $quiz = 2;
                }
                DB::table('seller_deals')
                    ->insert([
                        'user_id' => $user->id,
                        'book' => $books,
                        'project' => $projects,
                        'megazine' => $megazine,
                        'quiz' => $quiz,
                    ]);
                DB::table('seller_bank_account')
                        ->insert([
                            'user_id' => $user->id,
                        ]);
            }
            if ($request->input('user_role') == 1) {
                return redirect()->route('web.user_login')->with('message','User Registered Successfully Please Login With Email Id With Password');           
            }else{
                return redirect()->route('seller_login')->with('message','Seller Registered Successfully Please Login With Email Id With Password');           
            }
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }

    }
}
