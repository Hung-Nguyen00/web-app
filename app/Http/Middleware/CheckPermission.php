<?php

namespace App\Http\Middleware;

use App\PermissionRole;
use Closure;

class CheckPermission
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
        $permissions = PermissionRole::getPermissions(auth()->user()->role->id);
        $request->request->add([
                'scopes'=> $permissions,
            ]
        );
        return $next($request);
    }
}
