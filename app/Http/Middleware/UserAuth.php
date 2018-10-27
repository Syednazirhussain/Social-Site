<?php

namespace App\Http\Middleware;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Closure;

use Auth;

class UserAuth
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
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->hasAnyRole(['Fans','Talents']))
            {
                return $next($request);
            }
            else
            {
                return redirect()->back();      
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}
