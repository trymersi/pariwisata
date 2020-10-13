<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Kabupaten
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
        if(auth()->user()->level == 7)
        {
            return $next($request);
        }
   
        return redirect('home')->with('error',"You don't have admin access.");
    }
}
