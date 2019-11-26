<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;
use Auth;

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

    	return view('seller.books.add_book_form',compact('category','sub_category','language'));
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

        $seller_id = Auth::guard('seller')->user()->id;
        $book_insert = DB::table('books')
            ->insert([
                'user_id' =>  $seller_id,
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
                'approve_status' => 2,
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
        return view('seller.books.book_list');
    }

    public function ajaxBookList()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $query = DB::table('books')
            ->where('user_id',$seller_id)
            ->whereNull('deleted_at')
            ->orderBy('id','desc');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.book_detail_view',['book_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.edit_book_form',['book_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>                 
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.book_status_update',['book_id'=>encrypt($row->id),'status' => encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.book_status_update',['book_id'=>encrypt($row->id),'status' => encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
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

        return view('seller.books.edit_book',compact('category','sub_category','language','book'));
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
        $seller_id = Auth::guard('seller')->user()->id;
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
                ->where('user_id',$seller_id)
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
            ->where('user_id',$seller_id)
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
        $seller_id = Auth::guard('seller')->user()->id;
        $book_status = DB::table('books')
            ->where('id',$book_id)
            ->where('user_id',$seller_id)
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
        return view('seller.books.book_details',compact('book','seller'));
    }
}
