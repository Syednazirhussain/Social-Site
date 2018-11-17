<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Spatie\Permission\Models\Role;

class FanMiddleware
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
        $user = Auth::user();

        if($user->hasRole('Fans') && $user->plan_code == 'free')
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('user.login');
        }


        
    }
}
