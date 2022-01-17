<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessRight
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == 'admin')
        {
            return $next($request);
        }
        else
        {
            //session()->flush();
            return redirect('/');
        }
        return redirect('/');
    }
}
