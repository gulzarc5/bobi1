<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;
use Response;
use Auth;

class QuizController extends Controller
{
    public function addQuizForm()
    {
    	$category = DB::table('quiz_category')
    		->whereNull('deleted_at')
    		->get();

    	return view('seller.quiz.add_quiz_form',compact('category'));
	}
	
	public function addQuiz(Request $request)
    {
    	$validatedData = $request->validate([
			'name' => 'required',
            'category' => 'required'
        ]);
        $user_id = Auth::guard('seller')->id();
        
        $quiz_insert = DB::table('quiz')
            ->insert([
                'user_id' =>  $user_id,
                'category_id' => $request->input('category'),
                'name' => $request->input('name'),
                'pages' => $request->input('pages'),
                'approve_status' => 2,
                'description' => $request->input('description'),
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
        return view('seller.quiz.quiz_list');
    }

    public function ajaxQuizList()
    {
        $user_id = Auth::guard('seller')->id();
        $query = DB::table('quiz')	
        ->select('quiz.*', 'quiz_category.name as cat_name')
        ->where('user_id',$user_id)
        ->leftJoin('quiz_category', 'quiz.category_id', '=', 'quiz_category.id')
        ->whereNull('quiz.deleted_at')
        ->orderBy('quiz.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.quiz_detail_view',['quiz_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.edit_quiz_form',['quiz_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.quiz_status_update',['quiz_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.quiz_status_update',['quiz_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                        return $btn;
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

        return view('seller.quiz.edit_quiz',compact('category','quiz'));
    }

    public function updateQuiz(Request $request)
    {
    	$validatedData = $request->validate([
            'quiz_id' => 'required',
			'name' => 'required',
            'category' => 'required',
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
        return view('seller.quiz.quiz_details',compact('quiz', 'seller'));
    }
}
