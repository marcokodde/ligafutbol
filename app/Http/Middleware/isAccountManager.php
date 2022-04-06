<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAccountManager
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isAccountManager()) {
            return $next($request);
        }
        session()->flash('alert',__('You have no Account Manager access'));
        return redirect()->route('dashboard')->with('error',__('You have not Account Manager access'));
    }

}
