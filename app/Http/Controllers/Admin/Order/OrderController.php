<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class OrderController extends Controller
{
    public function BookOrderDispatchedForm($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        return view('admin.orders.book_orders.order_dispatch',compact('order_id'));
    }

    public function BookOrderDispatched(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'courier_name' => 'required',
            'consignment' => 'required',
        ]);

        $update_order_details =DB::table('book_order_details')
            ->where('id',$request->input('order_id'))
            ->update([
                'courier_name' => $request->input('courier_name'),
                'consighment_no' => $request->input('consignment'),
                'status' => 2,
            ]);
        if ($update_order_details) {
            $order = DB::table('book_order_details')->where('id',$request->input('order_id'))->first();
            $check_order_status = DB::table('book_order_details')
                ->where('order_id',$order->order_id)
                ->get();
            $status_update = true;
            foreach ($check_order_status as $key => $value) {
                if ($value->status < 2) {
                    $status_update = false;
                    break;
                }
            }

            if ($status_update == true) {
                $order_update = DB::table('book_orders')
                    ->where('id',$order->order_id)
                    ->update([
                        'status' => 2,
                    ]);
            }

            return redirect()->route('admin.book_order_detail',['order_id'=>encrypt( $order->order_id)]);
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function bookOrderStatus($order_id,$status)
    {
        try {
            $order_id = decrypt($order_id);
            $status = decrypt($status);            
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $update_order_details =DB::table('book_order_details')
            ->where('id',$order_id)
            ->update([
                'status' => $status,
            ]);
        if ($update_order_details) {
            $order = DB::table('book_order_details')->where('id',$order_id)->first();
            $check_order_status = DB::table('book_order_details')
                ->where('order_id',$order->order_id)
                ->get();
            $status_update = true;
            foreach ($check_order_status as $key => $value) {
                if ($value->status < $status) {
                    $status_update = false;
                    break;
                }
            }

            if ($status_update == true) {
                $order_update = DB::table('book_orders')
                    ->where('id',$order->order_id)
                    ->update([
                        'status' => $status,
                    ]);
            }

            return redirect()->route('admin.book_order_detail',['order_id'=>encrypt( $order->order_id)]);
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function projectOrderList()
    {
        return view('admin.orders.project_orders.project_orders');
    }

    public function projectOrderAjaxList()
    {
        $query = DB::table('project_orders')
            ->select('project_orders.*','users.name as u_name', 'projects.name')
            ->leftJoin ('projects', 'project_orders.project_id', '=', 'projects.id')
            ->leftjoin('users','users.id','=','project_orders.user_id')
            ->orderBy('project_orders.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->editColumn('name', function($row){
               
               $btn = '<a href="'.route('admin.project_detail_view', ['project_id' => encrypt($row->project_id)]).'" class="link" target="_blank" style="color:red">'.$row->name.'</a>';

               return $btn;
            })
            ->addColumn('seller_name', function($row){
               if ($row->seller_id != 'A') {

                    $user_data = DB::table('users')->select('name')->where('id', $row->seller_id)->first();
                    $btn = '<a class="link" href="'.route('admin.seller_view', ['seller_id' => encrypt($row->seller_id)]).'" target="_blank" style="color:red">'.$user_data->name.'</a>';

               } else {
                    $btn = '<a class="link">Admin</a>';

               }
                return $btn;
            })
            ->rawColumns(['seller_name', 'name','created_at'])
            ->make(true);
    }

     public function megazineOrderList()
    {
        return view('admin.orders.megazine_orders.megazine_orders');
    }

    public function megazineOrderAjaxList()
    {
        $query = DB::table('megazine_orders')
            ->select('megazine_orders.*','users.name as u_name', 'megazines.name')
            ->leftJoin ('megazines', 'megazine_orders.megazine_id', '=', 'megazines.id')
            ->leftjoin('users','users.id','=','megazine_orders.user_id')
            ->orderBy('megazine_orders.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->editColumn('name', function($row){
               
               $btn = '<a href="'.route('admin.megazine_detail_view', ['megazine_id' => encrypt($row->megazine_id)]).'" class="link" target="_blank" style="color:red">'.$row->name.'</a>';

               return $btn;
            })
            ->addColumn('seller_name', function($row){
               if ($row->seller_id != 'A') {

                    $user_data = DB::table('users')->select('name')->where('id', $row->seller_id)->first();
                    $btn = '<a class="link" href="'.route('admin.seller_view', ['seller_id' => encrypt($row->seller_id)]).'" target="_blank" style="color:red">'.$user_data->name.'</a>';

               } else {
                    $btn = '<a class="link">Admin</a>';

               }
                return $btn;
            })
            ->rawColumns(['seller_name', 'name','created_at'])
            ->make(true);
    }

    public function membershipList()
    {
        return view('admin.membership.membership_order');
    }

    public function membershipListAjax()
    {
        $query = DB::table('membership_order')
            ->select('membership_order.*','users.name as u_name')
            ->leftjoin('users','users.id','=','membership_order.user_id')
            ->orderBy('membership_order.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->rawColumns(['created_at'])
            ->make(true);
    }
}
