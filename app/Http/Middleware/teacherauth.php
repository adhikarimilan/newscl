<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class teacherauth
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
        if( Auth::guard('teacher')->user())
            if( Auth::guard('teacher')->user()->active)
                return $next($request);
            else {
                Auth::guard('teacher')->logout(); 
                return redirect()->route('teacher.login')->withError('Account not activated, please contact admin');
            }
        else
        return redirect()->route('teacher.login');
    }
}
