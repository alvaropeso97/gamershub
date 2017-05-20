<?php

namespace App\Http\Middleware;

use App\Exceptions\PageNotFoundException;
use Closure;

class PermissionMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $route_perm
     * @return mixed
     * @throws PageNotFoundException
     */
    public function handle($request, Closure $next, $route_perm)
    {
        if (auth()->check() && $this->hasPermission($route_perm))
        {
            return $next($request);
        } else {
            throw new PageNotFoundException();
        }
    }

    public function hasPermission($route_perm)
    {
        $userRole = auth()->user()->role;
        $status = false;
        $permissions = $userRole->permissions;
        foreach ($permissions as $permission) {
            if ($permission->id == $route_perm) {
                $status = true;
            }
        }
        return $status;
    }
}
