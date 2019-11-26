<?php

namespace App\Http\Controllers\Admin\Quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;
use Response;

class QuizController extends Controller
{
    public function addQuizForm()
    {
    	$category = DB::table('quiz_category')
    		->whereNull('deleted_at')
    		->get();

    	return view('admin.quiz.add_quiz_form',compact('category'));
	}
	
	public function addQuiz(Request $request)
    {
    	$validatedData = $request->validate([
			'name' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $quiz_insert = DB::table('quiz')
            ->insert([
                'user_id' => 'A',
                'category_id' => $request->input('category'),
                'name' => $request->input('name'),
                'pages' => $request->input('pages'),
                'description' => $request->input('description'),
                'approve_status' => 1,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($quiz_insert) {
            return redirect()->back()->with('message','Quiz Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function quizList()
    {
        return view('admin.quiz.quiz_list');
    }

    public function ajaxQuizList()
    {
        $query = DB::table('quiz')	
        ->select('quiz.*', 'quiz_category.name as cat_name')
        ->leftJoin('quiz_category', 'quiz.category_id', '=', 'quiz_category.id')
        ->whereNull('quiz.deleted_at')
        ->orderBy('quiz.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.quiz_detail_view',['quiz_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('admin.edit_quiz_form',['quiz_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.quiz_status_update',['quiz_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';

                    }else{
                       $btn .= '<a href="'.route('admin.quiz_status_update',['quiz_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';

                    }

                    if ($row->approve_status == '2') {
                        $btn .= '<a href="'.route('admin.quiz_approve',['quiz_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Approve</a>';

                     }
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function editQuizForm($quiz_id)
    {
        try {
            $quiz_id = decrypt($quiz_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = DB::table('quiz_category')
    		->whereNull('deleted_at')
    		->get();
        $quiz = DB::table('quiz')->where('id', $quiz_id)->first();

        return view('admin.quiz.edit_quiz',compact('category','quiz'));
    }

    public function updateQuiz(Request $request)
    {
    	$validatedData = $request->validate([
            'quiz_id' => 'required',
			'name' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);
        
        try {
            $quiz_id = decrypt($request->input('quiz_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $quiz_update = DB::table('quiz')
            ->where('id',$quiz_id)
            ->update([
                'category_id' => $request->input('category'),
                'name' => $request->input('name'),
                'pages' => $request->input('pages'),
                'description' => $request->input('description'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($quiz_update) {
            return redirect()->back()->with('message','Quiz Updated Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function quizDetailView($quiz_id)
    {
        try {
            $quiz_id = decrypt($quiz_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $quiz = DB::table('quiz')->where('quiz.id', $quiz_id)      
            ->select('quiz.*','quiz_category.name as cat_name')     
            ->leftjoin('quiz_category','quiz_category.id','=','quiz.category_id')
            ->first();
        $seller = null;
        if (!empty($quiz->user_id) && $quiz->user_id != "A") {
            $seller = DB::table('users')->where('id',$quiz->user_id)->first();
        }
        return view('admin.quiz.quiz_details',compact('quiz', 'seller'));
    }

    public function quizStatusUpdate($quiz_id,$status)
    {
        try {
            $quiz_id = decrypt($quiz_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $book_status = DB::table('quiz')
            ->where('id',$quiz_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_status) {
            return redirect()->back()->with('message','Quiz Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
        
    }

    public function quizApprove($quiz_id,$status)
    {
        try {
            $quiz_id = decrypt($quiz_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $book_status = DB::table('quiz')
            ->where('id',$quiz_id)
            ->update([
                'approve_status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_status) {
            return redirect()->back()->with('message','Quiz Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
        
    }

    public function quizFileDownload($quiz_id) {
        try {
            $quiz_id = decrypt($quiz_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        $quiz_file = DB::table('quiz')->select('file_name')->where('id',$quiz_id)->first();
        // dd($quiz_file);
        $path = storage_path('\app\files\quiz\\'.$quiz_file->file_name);
        if (!File::exists($path)) {
            abort(404);
        }        
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
