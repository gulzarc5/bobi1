<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    public function mainCategory()
    {
        $category = DB::table('category')
    		->whereNull('deleted_at')
    		->where('status',1)
            ->get();
        if ($category->count() < 1 ) {
            $category = [];
        }
    	$response = [
            'status' => true,
            'message' => 'category list',
            'data' => $category,
        ];    	
    	return response()->json($response, 200);
    }

    public function firstCategory($category_id)
    {
        $category = DB::table('first_category')
            ->whereNull('deleted_at')
            ->where('category_id',$category_id)
    		->where('status',1)
            ->get();
        if ($category->count() < 1 ) {
            $category = [];
        }
    	$response = [
            'status' => true,
            'message' => 'First category list',
            'data' => $category,
        ];    	
    	return response()->json($response, 200);
    }

    public function secondCategory($first_category_id)
    {
        $category = DB::table('second_category')
            ->whereNull('deleted_at')
            ->where('first_category_id',$first_category_id)
    		->where('status',1)
            ->get();
        if ($category->count() < 1 ) {
            $category = [];
        }
    	$response = [
            'status' => true,
            'message' => 'First category list',
            'data' => $category,
        ];    	
    	return response()->json($response, 200);
    }
}
