<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isCompany
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
        if (auth()->user()->isCompany !== 1) {
            return redirect('/')->with('flash', 'Access denied');
        };

        return $next($request);
    }
}
