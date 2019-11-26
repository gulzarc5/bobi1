<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class CheckValidAccessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        
        if (Auth::check()) {
            if (Auth::guard('admin')->check()) {
                return $next($request);
            } elseif(Auth::guard('seller')->check()) {
                try {
                    $project_id = decrypt($request->route('project_id'));
                }catch(DecryptException $e) {
                    abort(404);
                }
                $seller_id = Auth::guard('seller')->user()->id;


            }elseif(Auth::guard('buyer')->check()){

            }            
        }else{
         return redirect()->route('web.index');
        }
    }
}
