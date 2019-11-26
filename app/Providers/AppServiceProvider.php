<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;
use Auth;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('web.template.partials.header', function ($view) {
            $cart_count =0;    
            $cart_data = [];

            if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) 
            {
                $user_id = Auth::guard('buyer')->user()->id;
                $cart_count = DB::table('cart')->where('user_id',$user_id)->count();
                $cart = DB::table('cart')->where('user_id',$user_id)->get();
                // dd($cart_count);
                if (count($cart) > 0) {
                    foreach ($cart as $key => $item) {
                        $cart = DB::table('books')->where('id',$item->book_id)
                            ->whereNull('deleted_at')
                            ->where('status',1)
                            ->first();
                            $cart->quantity = $item->quantity;
                            $cart_data[] =$cart;
                    }
                }else{
                    $cart_data = false;
                }

            }else{
                if (Session::has('cart') && !empty(Session::get('cart'))) {
                    $cart_count = count(Session::get('cart'));
                    $cart = Session::get('cart');
                    $cart_data =[];

                    if (count($cart) > 0) {
                        foreach ($cart as $product_id => $value) {
                            $cart = DB::table('books')->where('id',$product_id)
                            ->whereNull('deleted_at')
                            ->where('status',1)
                            ->first();
                            $cart->quantity = $value['quantity'];
                            $cart_data[] =$cart;
                        }
                    }else{
                        $cart_data = false;
                    }
                }else{
                    $cart_count = 0;
                }
            }

            $cart_data_header = [
                'cart_count' => $cart_count,
                'cart_data' => $cart_data,
            ];
           
            //  dd($cart_data_header);
            //  die();
            $view->with('cart_data_header', $cart_data_header);
        });

        View::composer('seller.include.header', function ($view) {
            if( Auth::guard('seller')->user() && !empty(Auth::guard('seller')->user()->id)) {
                $seller_id = Auth::guard('seller')->user()->id;

                $dealing_category = DB::table('seller_deals')->where('user_id',$seller_id)->first();

                $header_data = [
                    'dealing_category' => $dealing_category,
                ];
                $view->with('header_data', $header_data);
            }
        });

    }
}
