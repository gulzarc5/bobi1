<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use File;
use Auth;
use Response;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class MegazineController extends Controller
{
    public function addMegazineForm()
    {
    	$magazine_category = DB::table('magazine_category')
    		->get();

    	return view('seller.megazines.add_megazine_form',compact('magazine_category'));
    }

    public function addMegazine(Request $request)
    {
    	$validatedData = $request->validate([
            'megazine_category' => 'required',
            'megazine_name' => 'required',
            'cost' => 'required',
            'megazine_file' => 'required|file|mimes:pdf,doc,docx',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $seller_id = Auth::guard('seller')->user()->id;

        $cover_image = null;
        if($request->hasfile('cover_image'))
        {
        	$cover_image = $request->file('cover_image');
            $destination = base_path().'/public/images/megazines/';
            $cover_image_extension = $cover_image->getClientOriginalExtension();
            $cover_image_name = md5(date('now').time())."-".$request->input('megazine_name')."."."$cover_image_extension";
            $original_path = $destination.$cover_image_name;
            Image::make($cover_image)->save($original_path);
            $thumb_path = base_path().'/public/images/megazines/thumb/'.$cover_image_name;
            Image::make($cover_image)
            ->resize(300, 400)
            ->save($thumb_path);
        }

        $file_name_megazine = null;
        if($request->hasfile('megazine_file'))
        {
            $file = $request->file('megazine_file');
            $file_name_megazine = date('d-m-Y').'-'.$request->input('megazine_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/megazines/', $file_name_megazine);
        }

        $megazine_insert = DB::table('megazines')
            ->insert([
                'user_id' => $seller_id,
                'category_id' => $request->input('megazine_category'),
                'name' => $request->input('megazine_name'),
                'cost' => $request->input('cost'),
                'pages' => $request->input('pages'),
                'file_name' => $file_name_megazine,
                'cover_image' => $cover_image_name,
                'description' => $request->input('description'),
                'approval_status' => 2,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($megazine_insert) {
            return redirect()->back()->with('message','Megazine Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function megazineList()
    {
        return view('seller.megazines.megazine_list');
    }

    public function ajaxMegazineList()
    {
        $seller_id = Auth::guard('seller')->user()->id;

        $query = DB::table('megazines')	
        ->select('megazines.*', 'magazine_category.name as category_name')
        ->leftJoin('magazine_category', 'megazines.category_id', '=', 'magazine_category.id')
        ->where('user_id', $seller_id)
        ->whereNull('megazines.deleted_at')
        ->orderBy('megazines.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.megazine_detail_view',['megazine_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.edit_megazine_form',['book_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.megazine_status_update',['megazine_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.megazine_status_update',['megazine_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                        return $btn;
                    }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Enable</a>';
                 }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                 }
                 return $btn;
            })
            ->rawColumns(['action','status_tab'])
            ->make(true);
    }

    public function editMegazineForm($megazine_id)
    {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $magazine_category = DB::table('magazine_category')
            ->whereNull('deleted_at')
            ->get();
        $megazine = DB::table('megazines')->where('id', $megazine_id)->first();

        return view('seller.megazines.edit_megazine',compact('magazine_category','megazine'));
    }

    public function megazineUpdate(Request $request) 
    {
        $validatedData = $request->validate([
            'megazine_category' => 'required',
            'megazine_name' => 'required',
            'cost' => 'required',
            'megazine_file' => 'file|mimes:pdf,doc,docx',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            $megazine_id = decrypt($request->input('megazine_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $megazine_details = DB::table('megazines')
                                ->where('id', $megazine_id)
                                ->first();

        $cover_image = null;
        if($request->hasfile('cover_image'))
        {
            $cover_image = $request->file('cover_image');
            $destination = base_path().'/public/images/megazines/';
            $cover_image_extension = $cover_image->getClientOriginalExtension();
            $cover_image_name = md5(date('now').time())."-".$request->input('megazine_name')."."."$cover_image_extension";
            $original_path = $destination.$cover_image_name;
            Image::make($cover_image)->save($original_path);
            $thumb_path = base_path().'/public/images/megazines/thumb/'.$cover_image_name;
            Image::make($cover_image)
            ->resize(300, 400)
            ->save($thumb_path);
           
            File::delete(public_path()."/images/megazines/".$megazine_details->cover_image);
            File::delete(public_path()."/images/megazines/thumb/".$megazine_details->cover_image);
            DB::table('megazines')->where('id', $megazine_id)
                                ->update(['cover_image' => $cover_image_name]);
        }

        $megazine_file = null;
        if($request->hasfile('megazine_file'))
        {
            $file = $request->file('megazine_file');
            $megazine_file = date('d-m-Y').'-'.$request->input('megazine_name').'.'.$file->getClientOriginalExtension();
            $file->storeAs('files/megazines', $megazine_file);
            
            File::delete(storage_path()."/files/megazines/".$megazine_details->file_name);
            DB::table('megazines')->where('id', $megazine_id)
                                ->update(['file_name' => $megazine_file]);
        }

        $megazine_update = DB::table('megazines')
                            ->where('id', $megazine_id)
                            ->update([
                                'category_id' => $request->input('megazine_category'),
                                'name' => $request->input('megazine_name'),
                                'cost' => $request->input('cost'),
                                'pages' => $request->input('pages'),
                                'description' => $request->input('description'),
                                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);
        if ($megazine_update) {
            return redirect()->back()->with('message','Megazine updated Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function megazineStatusUpdate($megazine_id,$status)
    {
        try {
            $megazine_id = decrypt($megazine_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $megazine_status = DB::table('megazines')
            ->where('id',$megazine_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($megazine_status) {
            return redirect()->back()->with('message','Megazine Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

     public function megazineDetailView($megazine_id)
    {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_id = Auth::guard('seller')->user()->id;

        $megazine = DB::table('megazines')->where('megazines.id', $megazine_id)           
            ->leftJoin('magazine_category','megazines.category_id','=','magazine_category.id')
            ->select('megazines.*','magazine_category.name as category_name')
            ->first();
        $seller = null;
        if (!empty($megazine->user_id) && $megazine->user_id != "A") {
            $seller = DB::table('users')->where('id',$megazine->user_id)->first();
        }
        return view('seller.megazines.megazine_details',compact('megazine', 'seller'));
    }

    public function megazineFileView ($megazine_id) {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        $megazine_file = DB::table('megazines')->select('file_name')->where('id', $megazine_id)->first();

        $path = storage_path('\app\files\megazines\\'.$megazine_file->file_name);
        if (!File::exists($path)) 
            $response = 404;
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function coverImageView ($megazine_id) {
        try {
            $megazine_id = decrypt($megazine_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        $megazine_file = DB::table('megazines')->select('cover_image')->where('id', $megazine_id)->first();
        $path = public_path('\images\megazines\\'.$megazine_file->cover_image);
        if (!File::exists($path)) 
            $response = 404;
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
