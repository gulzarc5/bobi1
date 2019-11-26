<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConfigurationController extends Controller
{
   
    //******************State Section******************

    public function ViewStateForm()
    {
        $state = DB::table('state')->whereNull('deleted_at')->get();
        return view('admin.configuration.add_state',compact('state'));
    }

    public function AddStateForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $state = DB::table('state')
        ->insert([
            'name' => $request->input('name'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function EditState($id)
    {
        $state_edit = DB::table('state')->where('id',$id)->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();
        return view('admin.configuration.add_state',compact('state','state_edit'));

    }

    public function updateState(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);

        $state = DB::table('state')
        ->where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function deleteState($id)
    {
        $timestamp = now()->toDateTimeString();
        $state = DB::table('state')
        ->where('id',$id)
        ->update([
            'deleted_at' => $timestamp,
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    //***************City Section***************

    public function ViewCityForm()
    {
        $states = DB::table('state')->whereNull('deleted_at')->get()->pluck('name','id');
        return view('admin.configuration.add_city',compact('states'));
    }

    public function AddCity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $state = DB::table('city')
        ->insert([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','City Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function cityList()
    {
       return view('admin.configuration.city_list');
    }

    public function ajaxCityList()
    {
       $query = DB::table('city')
        ->select('city.*','state.name as s_name')
        ->join('state','city.state_id','=','state.id')
        ->whereNull('city.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.edit_city',['id'=>$row->id]).'" class="btn btn-warning btn-sm">Edit</a>
                   <a href="'.route('admin.delete_city',['id'=>$row->id]).'" class="btn btn-danger btn-sm">Delete</a>                   
                   ';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function EditCity($id)
    {
        $states = DB::table('state')->whereNull('deleted_at')->get()->pluck('name','id');
        $city = DB::table('city')->where('id',$id)->first();


        return view('admin.configuration.add_city',compact('states','city'));
    }

    public function updateCity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'id' => 'required',
        ]);

        $state = DB::table('city')
        ->where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','City Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function deleteCity($id)
    {
       $city_delete = DB::table('city')->where('id',$id)->delete();
       if ($city_delete) {
            return redirect()->back()->with('message','City Deleted Successfully');
       }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
       }
    }

    public function cityWithState($id)
    {
       $city = DB::table('city')->where('state_id',$id)->get()->pluck('name','id');
       return $city;
    }
}
