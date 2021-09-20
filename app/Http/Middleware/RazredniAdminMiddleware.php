<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RazredniAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('korisnik')){
            if(session('korisnik')->id_uloga == 1 || session('korisnik')->id_uloga == 2){
                return $next($request);
            }
            else if (session('korisnik')->id_uloga == 4) {
                return redirect('/roditelj');
            }
            else{
                return redirect('/home');
            }
        }
        else{
            return redirect('/');
        }
    }
}
