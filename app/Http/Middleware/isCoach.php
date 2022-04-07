<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isCoach
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isCoach()) {
            return $next($request);
        }
        session()->flash('alert',__('You have not Coach Access'));
        return redirect()->route('dashboard')->with('error',__('You have not Coach Access'));
    }

}
