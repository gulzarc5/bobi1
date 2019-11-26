<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use File;
use Carbon\Carbon;
use Auth;
use Response;

class ProjectController extends Controller
{
    public function addProjectForm()
    {
    	$project_spalization = DB::table('project_spalization')
    		->get();

    	return view('seller.projects.add_project_form',compact('project_spalization'));
    }

    public function addProject(Request $request)
    {
    	$validatedData = $request->validate([
            'specialization' => 'required',
            'project_name' => 'required',
            'cost' => 'required',
            'preview' => 'required|file|mimes:pdf,doc,docx,ppt',
            'documentation' => 'file|mimes:pdf,doc,docx,ppt',
            'synopsis' => 'file|mimes:pdf,doc,docx,ppt',
            'ppt' => 'file|mimes:ppt',
        ]);

        $seller_id = Auth::guard('seller')->user()->id;

        $file_name_preview = null;
        if($request->hasfile('preview'))
        {
        	$file = $request->file('preview');
    		$file_name_preview = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/preview', $file_name_preview);
        }

        $file_name_documentation = null;
        if($request->hasfile('documentation'))
        {
            $file = $request->file('documentation');
            $file_name_documentation = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/documentation', $file_name_documentation);
        }

        $file_name_synopsis = null;
        if($request->hasfile('synopsis'))
        {
            $file = $request->file('synopsis');
            $file_name_synopsis = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/synopsis', $file_name_synopsis);
        }

        $file_name_ppt = null;
        if($request->hasfile('ppt'))
        {
            $file = $request->file('ppt');
            $file_name_ppt = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/ppt', $file_name_ppt);
        }

        $project_insert = DB::table('projects')
            ->insert([
                'user_id' => $seller_id,
                'specialization_id' => $request->input('specialization'),
                'name' => $request->input('project_name'),
                'cost' => $request->input('cost'),
                'pages' => $request->input('pages'),
                'documentation' => $file_name_documentation,
                'synopsis' => $file_name_synopsis,
                'preview' => $file_name_preview,
                'ppt' => $file_name_ppt,
                'description' => $request->input('description'),
                'approval_status' => 2,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($project_insert) {
            return redirect()->back()->with('message','Project Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function projectList()
    {
        return view('seller.projects.project_list');
    }

    public function ajaxProjectList()
    {
    	$seller_id = Auth::guard('seller')->user()->id;

        $query = DB::table('projects')	
        ->select('projects.*', 'project_spalization.name as spalization_name')
        ->leftJoin('project_spalization', 'projects.specialization_id', '=', 'project_spalization.id')
        ->where('projects.user_id', $seller_id)
        ->whereNull('projects.deleted_at')
        ->orderBy('projects.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.project_detail_view',['project_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.edit_project_form',['project_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.project_status_update',['project_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.project_status_update',['project_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
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

    public function projectDetailView($project_id)
    {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $project = DB::table('projects')->where('projects.id', $project_id)           
            ->leftjoin('project_spalization','projects.specialization_id','=','project_spalization.id')
            ->select('projects.*','project_spalization.name as specialization_name')
            ->first();
        $seller = null;
        if (!empty($project->user_id) && $project->user_id != "A") {
            $seller = DB::table('users')->where('id',$project->user_id)->first();
        }
        return view('seller.projects.project_details',compact('project', 'seller'));
    }

    public function previewFileView($project_id) {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        $project_file = DB::table('projects')->select('preview')->where('id', $project_id)->first();
        $path = storage_path('\app\files\projects\preview\\'.$project_file->preview);
        if (!File::exists($path)) {
            abort(404);
        }        
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function editProjectForm($project_id)
    {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $project_spalization = DB::table('project_spalization')
    		->whereNull('deleted_at')
    		->get();
        $project = DB::table('projects')->where('id', $project_id)->first();

        return view('seller.projects.edit_project',compact('project_spalization','project'));
    }

    public function projectUpdate(Request $request) 
    {
    	$validatedData = $request->validate([
    		'project_id' => 'required',
            'specialization' => 'required',
            'project_name' => 'required',
            'cost' => 'required',
            'preview' => 'file|mimes:pdf,doc,docx,ppt',
            'documentation' => 'file|mimes:pdf,doc,docx,ppt',
            'synopsis' => 'file|mimes:pdf,doc,docx,ppt',
            'ppt' => 'file|mimes:ppt',
        ]);

        try {
            $project_id = decrypt($request->input('project_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $project_details = DB::table('projects')
        						->where('id', $project_id)
        						->first();

        $file_name_preview = null;
        if($request->hasfile('preview'))
        {
    		$file = $request->file('preview');
    		$file_name_preview = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/preview', $file_name_preview);
        	DB::table('projects')->where('id', $project_id)
        						->update(['preview' => $file_name_preview]);
        	File::delete(storage_path()."/files/projects/preview/".$project_details->preview);
        }

        $file_name_documentation = null;
        if($request->hasfile('documentation'))
        {
            $file = $request->file('documentation');
            $file_name_documentation = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/documentation', $file_name_documentation);
        	DB::table('projects')->where('id', $project_id)
        						->update(['documentation' => $file_name_documentation]);
        	File::delete(storage_path()."/files/projects/documentation/".$project_details->documentation);
        }

        $file_name_synopsis = null;
        if($request->hasfile('synopsis'))
        {
            $file = $request->file('synopsis');
            $file_name_synopsis = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/synopsis', $file_name_synopsis);
        	DB::table('projects')->where('id', $project_id)
        						->update(['synopsis' => $file_name_synopsis]);
        	File::delete(storage_path()."/files/projects/synopsis/".$project_details->synopsis);
        }

        $file_name_ppt = null;
        if($request->hasfile('ppt'))
        {
            $file = $request->file('ppt');
            $file_name_ppt = date('d-m-Y').'-'.$request->input('project_name').'.'.$file->getClientOriginalExtension();
    		$file->storeAs('files/projects/ppt', $file_name_ppt);
        	DB::table('projects')->where('id', $project_id)
        						->update(['ppt' => $file_name_ppt]);
        	File::delete(storage_path()."/files/projects/ppt/".$project_details->ppt);
        }

        $project_update = DB::table('projects')
				        	->where('id', $project_id)
				            ->update([
				                'specialization_id' => $request->input('specialization'),
				                'name' => $request->input('project_name'),
				                'cost' => $request->input('cost'),
				                'pages' => $request->input('pages'),
				                'description' => $request->input('description'),
				                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
				            ]);
        if ($project_update) {
            return redirect()->back()->with('message','Project updated Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function projectStatusUpdate($project_id,$status)
    {
        try {
            $project_id = decrypt($project_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $project_status = DB::table('projects')
            ->where('id',$project_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($project_status) {
            return redirect()->back()->with('message','Project Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function documentationFileView ($project_id) {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        $project_file = DB::table('projects')->select('documentation')->where('id', $project_id)->first();
        $path = storage_path('app\files\projects\documentation\\'.$project_file->documentation);
        if (!File::exists($path)) 
            $response = 404;
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function synopsisFileView ($project_id) {
        try {
            $project_id = decrypt($project_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        $project_file = DB::table('projects')->select('synopsis')->where('id', $project_id)->first();    
        $path = storage_path('\app\files\projects\synopsis\\'.$project_file->synopsis);
        if (!File::exists($path)) 
            $response = 404;
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
