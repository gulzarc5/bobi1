<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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
}
