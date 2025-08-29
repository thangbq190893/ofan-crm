<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IdentifyBranch
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            session(['branch_id' => Auth::user()->branch_id]);
        }
        return $next($request);
    }
}
