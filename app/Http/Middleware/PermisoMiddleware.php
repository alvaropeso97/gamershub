<?php

namespace App\Http\Middleware;

use Closure;

class PermisoMiddleware
{
    public function handle($request, Closure $next, $permiso)
    {
        if (auth()->check() && (auth()->user()->tienePermiso($permiso) || auth()->user()->acceso == 333))
        {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}