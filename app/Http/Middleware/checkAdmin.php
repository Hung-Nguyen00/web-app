<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class checkAdmin
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

        $userRoles = auth()->user()->roles->pluck('name');

        if(!$userRoles->contains('admin'))
        {
            return redirect()->route('posts.index');
        }
        return $next($request);
    }
}
