<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isDeptoLead
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isDeptoLead()) {
            return $next($request);
        }
        session()->flash('alert',__('You have no Departament Lead access'));
        return redirect()->route('dashboard')->with('error',__('You have not Departament Lead access'));
    }

}
