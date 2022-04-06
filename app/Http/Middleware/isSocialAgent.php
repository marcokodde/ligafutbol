<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSocialAgent
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isSocialAgent()) {
            return $next($request);
        }
        session()->flash('alert',__('You have not Social Media Agent access'));
        return redirect()->route('dashboard')->with('error',__('You have not Social Media Agent access'));
    }

}
