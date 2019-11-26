<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Crypt;
use File;
use Response;
use Auth;

class MegazineController extends Controller
{
    public function megazineList()
    {   
         Session::forget('megazine_category');    
        
        $new_books_count = DB::table('books')
         ->where('book_condition',1)
         ->where('status',1)
         ->where('approve_status',1)
         ->whereNull('deleted_at')
         ->count();
        $old_books_count = DB::table('books')
            ->where('book_condition',2)
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();
        $projects_count = DB::table('projects')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $megazines_count = DB::table('megazines')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $quiz_count = DB::table('quiz')
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();
        $megazine = DB::table('megazines')
        				->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
                        ->select('megazines.*', 'magazine_category.name as m_name')
        				->whereNull('megazines.deleted_at')
                        ->where('megazines.status',1)
                        ->where('megazines.approval_status',1)
        				->paginate(12);
        $category = DB::table('magazine_category')
                                ->get();
                            
        return view('web.megazines',compact('megazine', 'category','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function ajaxMegazineList(Request $request)
    {
        $category = Session::get('megazine_category');
        $megazine_search_value = $request->input('megazine_search_value');
       
        // DB::connection()->enableQueryLog();
        $megazine = DB::table('megazines')
        ->select('megazines.*', 'magazine_category.name as m_name')
        ->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
        ->where('megazines.status',1)
        ->where('megazines.approval_status',1)
        ->whereNull('megazines.deleted_at')
        ->where(function($q) use ($megazine_search_value) {
            if (isset($megazine_search_value) && !empty($megazine_search_value) ) {  
                $q->where('megazines.name','like', $megazine_search_value.'%');
            }         
        });
        if (!empty($category)) {
            $megazine->where('megazines.category_id',$category);
        }
        $megazine = $megazine->paginate(12);
        // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
        // \DB::getQueryLog()[0]['query']));
        return view('web.pagination.megazine_search',compact('megazine'));
    }

    public function megazineListCategory($category_id)
    {
        Session::forget('megazine_category');
        if (!empty($category_id)) {
            try {
                $category_id = decrypt($category_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
            Session::put('megazine_category', $category_id); 
        }

        $new_books_count = DB::table('books')
         ->where('book_condition',1)
         ->where('status',1)
         ->where('approve_status',1)
         ->whereNull('deleted_at')
         ->count();
        $old_books_count = DB::table('books')
            ->where('book_condition',2)
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();
        $projects_count = DB::table('projects')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $megazines_count = DB::table('megazines')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $quiz_count = DB::table('quiz')
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();
        $megazine = DB::table('megazines')
                        ->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
                        ->select('megazines.*', 'magazine_category.name as m_name')
                        ->whereNull('megazines.deleted_at')
                        ->where('megazines.status',1)
                        ->where('megazines.approval_status',1);
        $category = DB::table('magazine_category')
                                ->get();

        if (!empty($category_id)) {
            $megazine->where('category_id',$category_id);
        }
        $megazine = $megazine->paginate(12);

        return view('web.megazines',compact('megazine', 'category','category','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function megazineDetail($megazine_id) {

        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $new_books_count = DB::table('books')
        ->where('book_condition',1)
        ->where('status',1)
        ->where('approve_status',1)
        ->whereNull('deleted_at')
        ->count();
        $old_books_count = DB::table('books')
            ->where('book_condition',2)
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();
        $projects_count = DB::table('projects')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $megazines_count = DB::table('megazines')
            ->where('status',1)
            ->where('approval_status',1)
            ->whereNull('deleted_at')
            ->count();
        $quiz_count = DB::table('quiz')
            ->where('status',1)
            ->where('approve_status',1)
            ->whereNull('deleted_at')
            ->count();

        $megazine = DB::table('megazines')
                        ->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
                        ->select('megazines.*', 'magazine_category.name as m_name')
                        ->where('megazines.id', $megazine_id)
                        ->get();

        $purchase_status = 1;
        if (Auth::guard('buyer')->check()) {
            if($megazine){
                $order_check_count = DB::table('megazine_orders')
                                    ->where('user_id', Auth::guard('buyer')->user()->id)
                                    ->where('megazine_id',$megazine_id)
                                    ->where('payment_status', 1)
                                    ->count();
            
                if(!empty($order_check_count))                    
                    $purchase_status = 2;
            }
        }
        
        return view('web.megazine-detail', compact('megazine','purchase_status','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

     public function megazineFileDownload($megazine_id) {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        $megazine_file = DB::table('megazines')->select('file_name')->where('id', $megazine_id)->first();    
        $path = storage_path('app\files\megazines\\'.$megazine_file->file_name);
        if (!File::exists($path)){
            $response = 404;
            return $response;
        } 
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
