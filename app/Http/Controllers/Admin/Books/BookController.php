<?php

namespace App\Http\Controllers\Admin\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;

class BookController extends Controller
{
    public function addBookForm()
    {
    	$category = DB::table('book_category')
    		->whereNull('deleted_at')
    		->get();
    	$sub_category = DB::table('book_sub_category')
    		->whereNull('deleted_at')
            ->get();
        $language = DB::table('book_language')
            ->where('status',1)
    		->whereNull('deleted_at')
    		->get();

    	return view('admin.books.add_book_form',compact('category','sub_category','language'));
    }

    public function addBook(Request $request)
    {
    	$validatedData = $request->validate([
            'book_name' => 'required',
            'author_name' => 'required',
            'publisher_name' => 'required',
            'book_condition' => 'required',
            'book_type' => 'required',
            'category' => 'required',
            'language' => 'required',
            'stock' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        ]);

        $image_name = null;
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $destination = base_path().'/public/images/book_image/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = base_path().'/public/images/book_image/thumb/'.$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);
        }


        $book_insert = DB::table('books')
            ->insert([
                'user_id' => 'A',
                'category_id' => $request->input('category'),
                'sub_category_id' => $request->input('sub_category'),
                'language_id' => $request->input('language'),
                'book_name' => $request->input('book_name'),
                'author_name' => $request->input('author_name'),
                'publisher_name' => $request->input('publisher_name'),
                'published_year' => $request->input('published_year'),
                'isbn' => $request->input('isbn'),
                'mrp' => $request->input('mrp'),
                'price' => $request->input('price'),
                'shipping_charge' => $request->input('shipping_charge'),
                'book_condition' => $request->input('book_condition'),
                'book_type' => $request->input('book_type'),
                'stock' => $request->input('stock'),
                'book_type' => $request->input('book_type'),
                'book_image' => $image_name,
                'description' => $request->input('description'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_insert) {
            return redirect()->back()->with('message','Book Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function bookList()
    {
        return view('admin.books.book_list');
    }

    public function ajaxBookList()
    {
        $query = DB::table('books')
        ->whereNull('deleted_at')
        ->orderBy('id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.book_detail_view',['book_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('admin.edit_book_form',['book_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.book_status_update',['book_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';

                    }else{
                       $btn .= '<a href="'.route('admin.book_status_update',['book_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';

                    }
                    if ($row->approve_status == '2') {
                       $btn .= '<a href="'.route('admin.book_approve',['book_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Approve</a>';
                       # code...
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

    public function editBookForm($book_id)
    {
        try {
            $book_id = decrypt($book_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = DB::table('book_category')
    		->whereNull('deleted_at')
    		->get();
    	$sub_category = DB::table('book_sub_category')
    		->whereNull('deleted_at')
            ->get();
        $language = DB::table('book_language')
            ->where('status',1)
    		->whereNull('deleted_at')
            ->get();
        $book = DB::table('books')->where('id',$book_id)->first();

        return view('admin.books.edit_book',compact('category','sub_category','language','book'));
    }

    public function updateBook(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'book_name' => 'required',
            'author_name' => 'required',
            'publisher_name' => 'required',
            'book_condition' => 'required',
            'book_type' => 'required',
            'category' => 'required',
            'language' => 'required',
            'stock' => 'required',
            'image' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        ]);

        try {
            $book_id = decrypt($request->input('book_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $destination = base_path().'/public/images/book_image/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = base_path().'/public/images/book_image/thumb/'.$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);

            $book = DB::table('books')->select('book_image')->where('id',$book_id)->first();

            $book_image = DB::table('books')
                ->where('id',$book_id)
                ->update([
                    'book_image' => $image_name,
                ]);
            if ($book_image) {
                $destination_thumb = base_path().'/public/images/book_image/thumb/'.$book->book_image;
                File::delete($destination_thumb);
        
                $destination = base_path().'/public/images/book_image/'.$book->book_image;
                File::delete($destination);
        
            }
        }

        $book_update = DB::table('books')
            ->where('id',$book_id)
            ->update([
                'category_id' => $request->input('category'),
                'sub_category_id' => $request->input('sub_category'),
                'language_id' => $request->input('language'),
                'book_name' => $request->input('book_name'),
                'author_name' => $request->input('author_name'),
                'publisher_name' => $request->input('publisher_name'),
                'published_year' => $request->input('published_year'),
                'isbn' => $request->input('isbn'),
                'mrp' => $request->input('mrp'),
                'price' => $request->input('price'),
                'shipping_charge' => $request->input('shipping_charge'),
                'book_condition' => $request->input('book_condition'),
                'book_type' => $request->input('book_type'),
                'stock' => $request->input('stock'),
                'book_type' => $request->input('book_type'),
                'description' => $request->input('description'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_update) {
            return redirect()->back()->with('message','Book Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function bookStatusUpdate($book_id,$status)
    {
        try {
            $book_id = decrypt($book_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $book_status = DB::table('books')
            ->where('id',$book_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_status) {
            return redirect()->back()->with('message','Book Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
        
    }

    public function bookApprove($book_id,$status)
    {
        try {
            $book_id = decrypt($book_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $book_status = DB::table('books')
            ->where('id',$book_id)
            ->update([
                'approve_status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($book_status) {
            return redirect()->back()->with('message','Book Status Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function bookDetailView($book_id)
    {
        try {
            $book_id = decrypt($book_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $book = DB::table('books')
            ->select('books.*','book_category.name as category_name','book_sub_category.name as sub_cat_name','book_language.name as language')
            ->where('books.id',$book_id)
            ->leftjoin('book_category','book_category.id','=','books.category_id')
            ->leftjoin('book_sub_category','book_sub_category.id','=','books.sub_category_id')
            ->leftjoin('book_language','book_language.id','=','books.language_id')
            ->first();
        $seller = null;
        if (!empty($book->user_id) && $book->user_id != "A") {
            $seller = DB::table('users')->where('id',$book->user_id)->first();
        }
        return view('admin.books.book_details',compact('book'));
    }


    public function bookOrderList()
    {
        return view('admin.orders.book_orders.book_orders');
    }

    public function bookOrderAjaxList()
    {
        $query = DB::table('book_orders')
            ->select('book_orders.*','users.name as u_name')
            ->leftjoin('users','users.id','=','book_orders.user_id')
            ->whereNull('book_orders.deleted_at')
            ->orderBy('book_orders.id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('admin.book_order_detail',['order_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                //    if ($row->status == '1') {
                //        $btn .= '<a href="'.route('admin.book_status_update',['order_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Dispatched</a>
                //        <a href="'.route('admin.book_status_update',['order_id'=>encrypt($row->id),'status' => encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                //         return $btn;
                //     }elseif($row->status == '2'){
                //         $btn .= '<a href="'.route('admin.book_status_update',['order_id'=>encrypt($row->id),'status' => encrypt(3)]).'" class="btn btn-danger btn-sm">Delivered</a>';
                //          return $btn;
                //     }
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

        $order = DB::table('book_orders')
            ->select('book_orders.*','users.name as u_name')
            ->leftjoin('users','users.id','=','book_orders.user_id')
            ->where('book_orders.id',$order_id)
            ->whereNull('book_orders.deleted_at')
            ->first();
        $shipping_address = DB::table('user_shipping_address')
            ->select('user_shipping_address.*','state.name as s_name','city.name as c_name')
            ->leftjoin('state','state.id','=','user_shipping_address.state_id')
            ->leftjoin('city','city.id','=','user_shipping_address.city_id')
            ->where('user_shipping_address.id',$order->shipping_address_id)->first();
        $order_details = DB::table('book_order_details')
            ->select('book_order_details.*','books.book_name as book_name','book_language.name as language')
            ->leftjoin('books','books.id','=','book_order_details.book_id')
            ->leftjoin('book_language','book_language.id','=','books.language_id')
            ->where('book_order_details.order_id',$order_id)
            ->get();
        foreach ($order_details as $key => $value) {
            if ($value->seller_id != "A") {
                $seller_name = DB::table('users')->where('id',$value->seller_id)->first();
                $value->seller_name = $seller_name->name;
            }else{
                $value->seller_name = 'Admin';
            }
        }
        // dd($order_details);
        return view('admin.orders.book_orders.details',compact('order_details','order','shipping_address'));
    }
}
