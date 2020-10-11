<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class parentauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::guard('stdparent')->user())
        return $next($request);
        else
        return redirect()->route('parent.login');
    }
}
