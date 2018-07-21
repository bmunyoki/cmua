<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            //User not logged in. Redirect to login
            return redirect('/login');
        }
    
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }
        //We got confused. Redirect home. 
        return redirect('/login');
    }
}
