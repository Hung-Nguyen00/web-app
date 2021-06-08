<?php

namespace App\Http\Middleware;

use Closure;

class CheckForAnyScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$scopes)
    {

        foreach ($scopes as $scope)
        {
            if(in_array($scope, $request->scopes)){
                return $next($request);
            }
        }
        return redirect()->route('admin.index');
    }
}
