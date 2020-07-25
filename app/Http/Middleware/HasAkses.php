<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HasAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $menu)
    {
        if (Auth::user()->hasMenu($menu))
            return $next($request);
        abort(403);
    }
}
