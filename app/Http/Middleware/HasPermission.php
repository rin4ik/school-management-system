<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $method = request()->method();
        $routeName = explode(".", Route::currentRouteName());
        $resource = $routeName[0];
        $user = auth()->user();
        $permission = $method === 'GET' ? "see $resource" : "edit $resource";
        if(array_key_exists(1, $routeName) && !$user->hasPermissionTo($permission)) 
        {
            return abort(403, 'Sorry Permission Denied');
        }
        return $next($request);
    }
}
