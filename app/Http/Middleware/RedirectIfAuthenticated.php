<?php

namespace App\Http\Middleware;

use App\Enum\UserType;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (Auth::user()->user_type){
                    case UserType::HOSPITAL :
                        return redirect(RouteServiceProvider::HOSPITAL_HOME);
                        break;
                    case UserType::ADMINISTRATOR :
                        return redirect(RouteServiceProvider::ADMIN_HOME);
                        break;
                    default:
                        return redirect('/');

                }
            }
        }

        return $next($request);
    }
}
