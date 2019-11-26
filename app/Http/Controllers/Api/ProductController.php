<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    public function productList($second_category,$page)
    {
        $limit = ($page*10)-10;
        $message = null;
        $products = DB::table('products')
            ->where('second_category',$second_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->skip($limit)
            ->take(10)
            ->get();

        $total_rows = clone $products;
        $total_rows = $total_rows->count();
        $total_page = ceil($total_rows/10);
        if ($total_rows > 0) {
            
            
            $first_cat = DB::table('second_category')->where('id',$second_category)->first();
            if ($first_cat) {
                $second_category = DB::table('second_category')
                    ->where('first_category_id',$first_cat->first_category_id)
                    ->whereNull('deleted_at')
                    ->where('status',1)
                    ->get();
                $color = DB::table('color')
                    ->where('first_category_id',$first_cat->first_category_id)
                    ->whereNull('deleted_at')
                    ->where('status',1)
                    ->get();
                $brands = DB::table('brand_name')
                    ->where('first_category',$first_cat->first_category_id)
                    ->whereNull('deleted_at')
                    ->where('status',1)
                    ->get();
                $sizes = DB::table('sizes')
                    ->where('first_category',$first_cat->first_category_id)
                    ->whereNull('deleted_at')
                    ->where('status',1)
                    ->get();

                $message = "Product List";
                $data = [
                    'products' => $products,
                    'second_category' => $second_category,
                    'color' => $color,
                    'designers' => $brands,
                    'sizes' => $sizes,
                ];
            }else{
                $message = "Second Category Not Found";
                $data = [
                    'products' => [],
                    'second_category' => [],
                    'color' => [],
                    'designers' => [],
                    'sizes' => [],
                ];
            }
        }else{
            $message = "No Products Found";
            $data = [
                'products' => [],
                'second_category' => [],
                'color' => [],
                'designers' => [],
                'sizes' => [],
            ];
        }
            
        $response = [
            'status' => true,
            'current_page' =>$page,
            'total_page' =>$total_page,
            'total_product' =>$total_rows,
            'message' => $message,
            'data' => $data,

        ];    	
    	return response()->json($response, 200);
    }

    public function productListWithFilter(Request $request)
    {
        $second_category = $request->input('second_category');
        $color_id = $request->input('color_id'); //Array Of Input
        $designer_id = $request->input('designer_id'); //Array Of Input
        $size_id = $request->input('size_id'); //Array Of Input
        $price_from = $request->input('price_from');
        if (empty($price_from)) {
            $price_from = 1;
        }
        $price_to = $request->input('price_to');
        $sort = $request->input('sort_by');

        $page = $request->input('page');
        if (!isset($page) && empty($page)) {
            $page = 1 ;
        }
        $total_page = 0;

        if (isset($second_category) && !empty($second_category)) {

            $product_count = DB::table('products')
            ->select('products.*')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            ->where(function($q) use ($designer_id) {
                if (isset($designer_id) && !empty($designer_id) && count((array)$designer_id) > 0 ) {
                    $brand_count = 1;
                    foreach ($designer_id as $key => $brand) {
                        if ($brand_count == 1) {
                            $q->where('products.brand_id',$brand);
                        }else{
                            $q->orWhere('products.brand_id',$brand);
                        }                       
                       $brand_count++;
                    }            
                 }
            })
            ->where(function($q2) use ($price_from,$price_to) {  
                if ((isset($price_from) && !empty($price_from)) && (isset($price_to) && !empty($price_to) )) {
                        $q2->whereBetween('products.min_price',[$price_from,$price_to]);
                }
            });
            if ((isset($size_id) && !empty($size_id) && count((array)$size_id) > 0) ) {
                $product_count->join('product_sizes','products.id', '=', 'product_sizes.product_id')
                ->where(function($q3) use ($size_id) {                    
                        $sizes_flag = 1;
                        foreach ($size_id as $key => $size) {
                            if ($sizes_flag == 1) {
                                $q3->where('product_sizes.size_id',$size);
                            }else{
                                $q3->orWhere('product_sizes.size_id',$size);
                            }                       
                        $sizes_flag++;
                        } 
                });
            };
            if (isset($color_id) && !empty($color_id) && count((array)$color_id) > 0 ) {
                $product_count->join('product_colors','products.id', '=', 'product_colors.product_id')
                ->where(function($q2) use ($color_id) {                    
                        $colors_count = 1;
                        foreach ($color_id as $key => $color) {
                            if ($colors_count == 1) {
                                $q2->where('product_colors.color_id',$color);
                            }else{
                                $q2->orWhere('product_colors.color_id',$color);
                            }                       
                        $colors_count++;
                        } 
                });
            };

            $product_Query = $product_count;
            $total_product = $product_count->distinct('products.id')->count('products.id');
            $total_page = intval(ceil($total_product / 10 ));
            $limit = ($page*10)-10;
            $pagination = [
                'current_page' => $page,
                'total_page' => $total_page,
                'total_product' => $total_product,
            ];

            if ($total_product > 0) {
                $product_after_filter =$product_Query
                ->distinct('products.id')
                ->skip($limit)
                ->take(10);

                if (isset($sort) && !empty($sort)) {
                    //Sort By Newest
                    if ($sort == '1') {
                        $product_after_filter->orderBy('products.id', 'desc');
                    }
                    // Sort By Low Price
                    elseif ($sort == '2') {
                        $product_after_filter->orderBy('products.min_price', 'asc');
                    }
                    // Sort By High Price
                    elseif ($sort == '3') {
                        $product_after_filter->orderBy('products.min_price', 'desc');
                    }
                    // Sort By Title Asc
                    elseif ($sort == '4') {
                        $product_after_filter->orderBy('products.name', 'asc');
                    }
                    // Sort By Title Desc
                    elseif ($sort == '5') {
                        $product_after_filter->orderBy('products.name', 'desc');
                    }
                }

                $message = "Product List After Filter";
                $product_after_filter = $product_after_filter->get();
            }else{
                $message = "No Product Found After Filter";
                $product_after_filter = [];
            }
           

            $response = [
                'status' => true,
                'pagination' =>$pagination,
                'message' => $message,
                'data' => $product_after_filter,    
            ];    	
            return response()->json($response, 200);
            
        }else{
            $data = [];
            $pagination = [
                'current_page' => $page,
                'total_page' => $total_page,
                'total_product' => $total_product,
            ];
            $response = [
                'status' => false,
                'pagination' =>$pagination,
                'message' => 'Required Field Can Not Be Empty',
                'data' => $data,
    
            ];    	
            return response()->json($response, 200);
        }


    }

    public function singleProductView($product_id)
    {
        $product = DB::table('products')
            ->where('id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first();
        if (count((array)$product) > 0) {
            $sizes = DB::table('product_sizes')
                ->select('product_sizes.*','sizes.name as size_name')
                ->join('sizes','sizes.id','=','product_sizes.size_id')
                ->where('product_sizes.product_id',$product_id)
                ->whereNull('product_sizes.deleted_at')
                ->where('product_sizes.status',1)
                ->get();            
            $colors = DB::table('product_colors')
                ->select('product_colors.color_id as color_id','color.name as color_name','color.value as color_value')
                ->join('color','product_colors.color_id','=','color.id')
                ->where('product_colors.product_id',$product_id)
                ->whereNull('product_colors.deleted_at')
                ->where('product_colors.status',1)
                ->get();
            $images = DB::table('product_image')
                ->where('product_id',$product_id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();
            
            $status = true;
            $message = "Product Details";
            $data = [
                'product' =>$product,
                'colors' => $colors,
                'sizes' => $sizes,
                'images' => $images,
            ];
        }else{
            $status = false;
            $message = "No Product Found";
            $data = [
                'product' =>null,
                'colors' => [],
                'sizes' => [],
                'images' => [],
            ];
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,    
        ];    	
        return response()->json($response, 200);
    }

    public function reletedProducts($second_category)
    {
        $products = DB::table('products')
            ->where('second_category',$second_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->inRandomOrder()
            ->take(10)
            ->get();
        
        if (count($products) > 0 ) {
            $status = true;
            $message = "Related Product List";
            $data = $products;
        }else{
            $status = false;
            $message = "No Products Found";
            $data = [];
        }
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,    
        ];    	
        return response()->json($response, 200);
    }
}
