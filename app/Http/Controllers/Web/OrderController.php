<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class OrderController extends Controller
{
    public function viewOrders($tab_status)
    {
        try {
            $tab_status = decrypt($tab_status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user_id = Auth::guard('buyer')->id();
        $book_orders = DB::table('book_order_details')
            ->select('book_order_details.*','books.book_name as book_name','books.price as price','books.book_image as book_image','book_orders.payment_status as payment_status')
            ->leftjoin('book_orders','book_orders.id','=','book_order_details.order_id')
            ->leftjoin('books','books.id','=','book_order_details.book_id')
            ->where('book_order_details.user_id',$user_id)
            ->orderBy('book_order_details.id','desc')
            ->get();

        $project_orders = DB::table('project_orders')
            ->where('project_orders.payment_status', 1)
            ->leftjoin('projects','project_orders.project_id','=','projects.id')
            ->select('project_orders.*','projects.name')
            ->where('project_orders.user_id',$user_id)
            ->orderBy('project_orders.id','desc')
            ->get();

        $megazine_orders = DB::table('megazine_orders')
            ->where('megazine_orders.payment_status', 1)
            ->leftjoin('megazines','megazine_orders.megazine_id','=','megazines.id')
            ->select('megazine_orders.*','megazines.name', 'megazines.cover_image')
            ->where('megazine_orders.user_id',$user_id)
            ->orderBy('megazine_orders.id','desc')
            ->get();

        $status = $tab_status;

        return view('web.user.orders',compact('book_orders', 'project_orders', 'megazine_orders','status'));
    }
}
