<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NormalUser
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
        if (auth()->user()->isCompany) {
            return redirect()
                ->route('home')
                ->with('flash', 'Access denied')
                ->with('flash-type', 'danger');
        }

        return $next($request);
    }
}
