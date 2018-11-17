<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;
use Spatie\Permission\Models\Role;

class AdminAuth
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
            if($user->hasAnyRole(['Admin','Web Master']))
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('admin.login');
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}
