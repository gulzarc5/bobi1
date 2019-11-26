<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use Carbon\Carbon;
use Response;
use Session;

class QuizController extends Controller
{
    public function quizList($category_id = NULL)
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
        $quiz_category = DB::table('quiz_category')
            ->where('status',1)
            ->whereNull('deleted_at')
            ->get();

       
        if (!empty($category_id)) {
            try {
                $category_id = decrypt($category_id);
            }catch(DecryptException $e) {
                return redirect()->back();
            }
            Session::put('quiz_category', $category_id); 
        }else{
            Session::forget('quiz_category');
        }

        $quiz = DB::table('quiz')
            ->select('quiz.*','quiz_category.name as cat_name')
            ->leftjoin('quiz_category','quiz_category.id','=','quiz.category_id')
            ->where('quiz.status',1)
            ->where('quiz.approve_status',1)
            ->whereNull('quiz.deleted_at');
            if (!empty($category_id)) {
                $quiz->where('quiz.category_id',$category_id);
            }
        $quiz = $quiz->orderBy('quiz.id','desc')->paginate(10);

        return view('web.quiz',compact('new_books_count','old_books_count','projects_count','megazines_count','quiz_count','quiz_category','quiz'));
    }

    public function ajaxQuizList(Request $request)
    {
        $category = Session::get('quiz_category');
        $search = $request->input('quiz_search_value');
       
        // DB::connection()->enableQueryLog();
        $quiz = DB::table('quiz')
        ->select('quiz.*','quiz_category.name as cat_name')
        ->leftjoin('quiz_category','quiz_category.id','=','quiz.category_id')
        ->where('quiz.status',1)
        ->where('quiz.approve_status',1)
        ->whereNull('quiz.deleted_at')
        ->where(function($q) use ($search) {
            $count_data = 1;
            if (isset($search) && !empty($search) ) {  
                $q->where('quiz.name','like',$search.'%');
            }         
        });
        if (!empty($category)) {
            $quiz->where('quiz.category_id',$category);
        }
        $quiz = $quiz->orderBy('quiz.id','desc')->paginate(10);
        // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
        // \DB::getQueryLog()[0]['query']));
        return view('web.pagination.quiz_search',compact('quiz'));
    }

    public function quizDetail($quiz_id)
    {
        try {
            $quiz_id = decrypt($quiz_id);
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
        $quiz_category = DB::table('quiz_category')
            ->where('status',1)
            ->whereNull('deleted_at')
            ->get();

        $quiz_details = DB::table('quiz')
            ->select('quiz.*','quiz_category.name as cat_name')
            ->leftjoin('quiz_category','quiz_category.id','=','quiz.category_id')
            ->where('quiz.id',$quiz_id)
            ->first();
        return view('web.quiz-veiw',compact('new_books_count','old_books_count','projects_count','megazines_count','quiz_count','quiz_details'));
        // return view('web.quiz-detail',compact('new_books_count','old_books_count','projects_count','megazines_count','quiz_count','quiz_details'));
    }

    public function quizPdfView($quiz_id)
    {
        try {
            $quiz_id = decrypt($quiz_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        $quiz_file = DB::table('quiz')->select('file_name')->where('id',$quiz_id)->first();
        
        $path = storage_path('\app\files\quiz\\'.$quiz_file->file_name);
        
        if (!File::exists($path)) {
            // dd($path);
            abort(404);
        }        
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
