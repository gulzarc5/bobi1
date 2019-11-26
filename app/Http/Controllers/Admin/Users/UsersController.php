<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller
{
    public function allSellers()
    {
    	return view('admin.users.seller_list');
    }

    public function ajaxAllSellers()
    {
    	$query = DB::table('users')        
        ->whereNull('deleted_at')
        ->where('user_role',2)
        ->orderBy('id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.seller_view',['seller_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                    if ($row->seller_approved_status == 1 ) {
                        $btn .= '<a href="'.route('admin.sellerUpdateVerification',['seller_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Verify</a>';
                    }
                    if ($row->status == 1) {  
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                    }else{
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-primary btn-sm">Enable</a>';
                    }
                    
             
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == 1) {
                    $btn = '<a class="btn btn-success btn-sm">Enabled</a>';
                }else{
                    $btn = '<a class="btn btn-danger btn-sm">Disabled</a>';
                }
                return $btn;
            })
            ->addColumn('seller_approved_status', function($row){
                if ($row->seller_approved_status == 2) {
                    $btn = '<a class="btn btn-success btn-sm">Verified</a>';
                }else{
                    $btn = '<a class="btn btn-danger btn-sm">Un Verified</a>';
                }
                return $btn;
            })
            ->rawColumns(['action','status_tab','seller_approved_status'])
            ->make(true);
    }

    public function allBuyers()
    {
    	return view('admin.users.buyer_list');
    }

    public function ajaxAllBuyers()
    {
    	$query = DB::table('users')        
        ->whereNull('deleted_at')
        ->where('user_role',1)
        ->orderBy('id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){   
                    if ($row->status == 1) {  
                        $btn = '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger btn-sm">DeActivate</a>';
                    }else{
                        $btn = '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-primary btn-sm">Activate</a>';
                    }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == 1) {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Disabled</a>';
                }
                return $btn;
            })
            ->rawColumns(['action','status_tab'])
            ->make(true);
    }

    public function sellerView($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller = DB::table('users')
            ->select('users.*','state.name as state_name','city.name as city_name','seller_bank_account.bank_name as b_name','seller_bank_account.branch_name as branch_name','seller_bank_account.account_no as account','seller_bank_account.ifsc as ifsc','seller_bank_account.upi_name as upi_name','seller_bank_account.upi_id as upi_id','seller_bank_account.upi_mobile as upi_mobile')
            ->leftjoin('state','state.id','=','users.state_id')
            ->leftjoin('city','city.id','=','users.city_id')            
            ->leftjoin('seller_bank_account','users.id','=','seller_bank_account.user_id')
            ->where('users.id',$seller_id)
            ->first();
        
        $dealing_category = DB::table('seller_deals')->where('user_id',$seller_id)->first();

        return view('admin.users.user_details',compact('seller','dealing_category'));
    }

    public function sellerUpdateVerification($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('users')
        ->where('id',$seller_id)
        ->update([
            'seller_approved_status' => 2,
        ]);
        return redirect()->back();
    }

    public function sellerUpdateStatus($seller_id,$status)
    {
        try {
            $seller_id = decrypt($seller_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('users')
        ->where('id',$seller_id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
