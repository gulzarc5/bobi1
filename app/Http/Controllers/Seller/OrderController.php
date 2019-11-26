<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Carbon\Carbon;
use Auth;
use Validator;

class OrderController extends Controller
{
    public function bookOrderList()
    {
        return view('seller.orders.book_orders.book_orders');
    }

    public function bookOrderAjaxList()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $query = DB::table('book_order_details')
            ->select('book_order_details.*','users.name as u_name','book_orders.payment_status as payment_status','book_orders.payment_method as payment_method')
            ->leftjoin('users','users.id','=','book_order_details.user_id')
            ->leftjoin('book_orders','book_orders.id','=','book_order_details.order_id')
            ->where('book_order_details.seller_id',$seller_id)
            ->orderBy('book_order_details.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('seller.book_order_detail',['order_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                   if ($row->status == '1') {
                       if ($row->payment_method == '1') {
                            $btn .= '<a href="'.route('seller.book_order_dispatch_form',['order_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-info btn-sm">Dispatched</a>
                            <a href="'.route('seller.book_order_status',['order_id'=>encrypt($row->id),'status' => encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                            return $btn;
                       }else{
                           if ($row->payment_status == '1') {
                                $btn .= '<a href="'.route('seller.book_order_dispatch_form',['order_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-info btn-sm">Dispatched</a>
                                <a href="'.route('seller.book_order_status',['order_id'=>encrypt($row->id),'status' => encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                                return $btn;
                           }else{
                                $btn .= '<a href="#" class="btn btn-danger btn-sm">Payment Failed</a>';
                                return $btn;
                           }
                       }           
                       
                    }elseif($row->status == '2'){
                        $btn .= '<a href="'.route('seller.book_order_status',['order_id'=>encrypt($row->id),'status' => encrypt(3)]).'" class="btn btn-success btn-sm">Delivered</a>';
                         return $btn;
                    }
                    return $btn;
            })
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                    $btn = '<a href="#" class="btn btn-warning btn-sm">Pending</a>';
                 }elseif($row->status == '2'){
                    $btn = '<a href="#" class="btn btn-info btn-sm">Dispatched</a>';
                 }elseif($row->status == '3'){
                    $btn = '<a href="#" class="btn btn-success btn-sm">Delivered</a>';
                 }elseif($row->status == '4'){
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Cancelled</a>';
                 }
                 return $btn;
            })
            ->rawColumns(['action','status_tab','created_at'])
            ->make(true);
    }

    public function bookOrderDetail($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $order_details = DB::table('book_order_details')
            ->select('book_order_details.*','books.book_name as book_name','book_language.name as language','users.name as u_name')
            ->leftjoin('users','users.id','=','book_order_details.user_id')
            ->leftjoin('books','books.id','=','book_order_details.book_id')
            ->leftjoin('book_language','book_language.id','=','books.language_id')
            ->where('book_order_details.id',$order_id)
            ->first();

        $order = DB::table('book_orders')
            ->where('book_orders.id',$order_details->order_id)
            ->whereNull('book_orders.deleted_at')
            ->first();
        $shipping_address = DB::table('user_shipping_address')
            ->select('user_shipping_address.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','user_shipping_address.state_id')
            ->leftjoin('city','city.id','=','user_shipping_address.city_id')
            ->where('user_shipping_address.id',$order->shipping_address_id)
            ->first();
     
        // dd($order_details);
        return view('seller.orders.book_orders.details',compact('order_details','order','shipping_address'));
    }

    public function BookOrderDispatchedForm($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        return view('seller.orders.book_orders.order_dispatch',compact('order_id'));
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

            return redirect()->route('seller.book_order_detail',['order_id'=>encrypt( $request->input('order_id'))]);
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

            return redirect()->route('seller.book_order_detail',['order_id'=>encrypt($order_id)]);
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function projectOrderList()
    {
        return view('seller.orders.project_orders.project_orders');
    }

    public function projectOrderAjaxList()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $query = DB::table('project_orders')
            ->select('project_orders.*','users.name as u_name', 'projects.name')
            ->leftJoin ('projects', 'project_orders.project_id', '=', 'projects.id')
            ->leftjoin('users','users.id','=','project_orders.user_id')
            ->where('project_orders.seller_id',$seller_id)
            ->orderBy('project_orders.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->editColumn('name', function($row){
               
               $btn = '<a href="'.route('seller.project_detail_view', ['project_id' => encrypt($row->project_id)]).'" class="link" target="_blank" style="color:red">'.$row->name.'</a>';

               return $btn;
            })
            ->rawColumns(['name','created_at'])
            ->make(true);
    }

    public function megazineOrderList()
    {
        return view('seller.orders.megazine_orders.megazine_orders');
    }

    public function megazineOrderAjaxList()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $query = DB::table('megazine_orders')
            ->select('megazine_orders.*','users.name as u_name', 'megazines.name')
            ->leftJoin ('megazines', 'megazine_orders.megazine_id', '=', 'megazines.id')
            ->leftjoin('users','users.id','=','megazine_orders.user_id')
            ->where('megazine_orders.seller_id',$seller_id)
            ->orderBy('megazine_orders.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
               return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->editColumn('name', function($row){
               
               $btn = '<a href="'.route('seller.megazine_detail_view', ['megazine_id' => encrypt($row->megazine_id)]).'" class="link" target="_blank" style="color:red">'.$row->name.'</a>';

               return $btn;
            })
            ->rawColumns(['name','created_at'])
            ->make(true);
    }
}
