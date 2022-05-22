<?php

namespace Modules\Administrator\Http\Middleware;

use App\Enum\UserType;
use Closure;
use Illuminate\Http\Request;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->user_type != UserType::ADMINISTRATOR){
            abort(403);
        }
        return $next($request);
    }
}
