<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Session;

class BookController extends Controller
{
    public function bookList($academic=null)
    {
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

        Session::forget('category');
        Session::forget('book_type');
        if (!empty($academic)) {
            try {
                $academic = decrypt($academic);
            }catch(DecryptException $e) {
                return redirect()->back();
            }

            Session::put('book_type', $academic); 
        }
        
       
        $book_language = DB::table('book_language')->whereNull('deleted_at')->where('status',1)->orderBy('name','asc')->get();
       
        $books = DB::table('books')
            ->where('status',1)
            ->where('approve_status',1)
            ->where('book_condition',1)
            ->whereNull('deleted_at');
        if (!empty($academic)) {
            $books->where('book_type',$academic);
        }
        $book_total = $books->count();
        $books = $books->paginate(12);
        $book_type = $academic;
        return view('web.books',compact('books','book_language','book_type','book_total','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function bookListCategory($category_id)
    {
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

        Session::forget('category');
        Session::forget('book_type');
        if (!empty($category_id)) {
            try {
                $category_id = decrypt($category_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
            Session::put('category', $category_id); 
        }
        $book_language = DB::table('book_language')->whereNull('deleted_at')->where('status',1)->orderBy('name','asc')->get();
       
        $books = DB::table('books')
            ->where('status',1)
            ->where('approve_status',1)
            ->where('book_condition',1)
            ->whereNull('deleted_at');
        if (!empty($category_id)) {
            $books->where('category_id',$category_id);
        }
        $books = $books->paginate(12);
        return view('web.books',compact('books','book_language','category_id','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function ajaxBookList(Request $request)
    {
        $category = Session::get('category');
        $book_type = Session::get('book_type');
        $language = $request->input('language');
        $book_title = $request->input('book_title');
        $publisher = $request->input('publisher');
       
        DB::connection()->enableQueryLog();
        $books = DB::table('books')
        ->where('status',1)
        ->where('approve_status',1)
        ->whereNull('deleted_at')
        ->where('book_condition',1)
        ->where(function($q) use ($language,$book_title,$publisher) {
            $count_data = 1;
            if (isset($language) && !empty($language) ) {  
                // if ($count_data == '1') {
                    $q->where('language_id',$language);
                //     $count_data++;
                // } else {
                //     $q->orWhere('language_id',$language);
                //     $count_data++;
                // }
            }  
            
            if (isset($book_title) && !empty($book_title) ) {       
                // if ($count_data == '1') {
                    $q->where('book_name','like',$book_title.'%');
                    // $count_data++;
                // } else {
                //     $q->orWhere('book_name','like',$book_title.'%');
                //     $count_data++;
                // }
            }    
            if (isset($publisher) && !empty($publisher) ) {               
                // if ($count_data == '1') {
                    $q->where('publisher_name','like',$publisher.'%');
                //     $count_data++;
                // } else {
                //     $q->orWhere('publisher_name','like',$publisher.'%');
                //     $count_data++;
                // }
            }         
        });
        if (!empty($category)) {
            $books->where('category_id',$category);
        }
        if (!empty($book_type)) {
            $books->where('book_type',$book_type);
        }
        $book_count = $books->count();
        $books = $books->paginate(12);
        // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
        // \DB::getQueryLog()[0]['query']));
        return view('web.pagination.book_search',compact('books','book_count'));
    }

    public function ajaxBookListOld(Request $request)
    {
        $category = Session::get('category');
        $book_type = Session::get('book_type');
        $language = $request->input('language');
        $book_title = $request->input('book_title');
        $publisher = $request->input('publisher');
       
        DB::connection()->enableQueryLog();
        $books = DB::table('books')
        ->where('status',1)
        ->where('approve_status',1)
        ->whereNull('deleted_at')
        ->where('book_condition',2)
        ->where(function($q) use ($language,$book_title,$publisher) {
            $count_data = 1;
            if (isset($language) && !empty($language) ) {  
                // if ($count_data == '1') {
                    $q->where('language_id',$language);
                //     $count_data++;
                // } else {
                //     $q->orWhere('language_id',$language);
                //     $count_data++;
                // }
            }  
            
            if (isset($book_title) && !empty($book_title) ) {       
                // if ($count_data == '1') {
                    $q->where('book_name','like',$book_title.'%');
                //     $count_data++;
                // } else {
                //     $q->orWhere('book_name','like',$book_title.'%');
                //     $count_data++;
                // }
            }    
            if (isset($publisher) && !empty($publisher) ) {               
                // if ($count_data == '1') {
                    $q->where('publisher_name','like',$publisher.'%');
                //     $count_data++;
                // } else {
                //     $q->orWhere('publisher_name','like',$publisher.'%');
                //     $count_data++;
                // }
            }         
        });
        if (!empty($category)) {
            $books->where('category_id',$category);
        }
        if (!empty($book_type)) {
            $books->where('book_type',$book_type);
        }
        $book_count = $books->count();
        $books = $books->paginate(12);
        // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
        // \DB::getQueryLog()[0]['query']));
        return view('web.pagination.book_search',compact('books','book_count'));
    }

    public function bookDetail($book_id)
    {
        try {
            $book_id = decrypt($book_id);
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

        $book_detail = DB::table('books')
            ->select('books.*','book_category.name as cat_name','book_language.name as lang_name')
            ->leftjoin('book_category','book_category.id','=','books.category_id')
            ->leftjoin('book_language','book_language.id','=','books.language_id')
            ->where('books.id',$book_id)
            ->first();
        return view('web.books-detail',compact('book_detail','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function bookListOld($academic=null)
    {
        Session::forget('category');
        Session::forget('book_type');
        if (!empty($academic)) {
            try {
                $academic = decrypt($academic);
            }catch(DecryptException $e) {
                return redirect()->back();
            }

            Session::put('book_type', $academic); 
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
       
        $book_language = DB::table('book_language')->whereNull('deleted_at')->where('status',1)->orderBy('name','asc')->get();
       
        $books = DB::table('books')
            ->where('status',1)
            ->where('approve_status',1)
            ->where('book_condition',2)
            ->whereNull('deleted_at');
        if (!empty($academic)) {
            $books->where('book_type',$academic);
        }
        $book_total = $books->count();
        $books = $books->paginate(12);
        
        $book_type = $academic;
        return view('web.old-books',compact('books','book_language','book_type','book_total','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }

    public function bookListCategoryOld($category_id)
    {
        Session::forget('category');
        Session::forget('book_type');
        if (!empty($category_id)) {
            try {
                $category_id = decrypt($category_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
            Session::put('category', $category_id); 
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

        $book_language = DB::table('book_language')->whereNull('deleted_at')->where('status',1)->orderBy('name','asc')->get();
       
        $books = DB::table('books')
            ->where('status',1)
            ->where('approve_status',1)
            ->where('book_condition',2)
            ->whereNull('deleted_at');
        if (!empty($category_id)) {
            $books->where('category_id',$category_id);
        }
        $books = $books->paginate(12);
        return view('web.books',compact('books','book_language','category_id','new_books_count','old_books_count','projects_count','megazines_count','quiz_count'));
    }
}
