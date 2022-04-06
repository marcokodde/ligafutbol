<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLicence
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
        if (Auth::user() &&  Auth::user()->isLicence()) {
            return $next($request);
        }
       session()->flash('alert',__('You have not Admin Licence access'));
       return redirect()->route('dashboard')->with('error',__('You have not Admin Licence access'));
    }

}
