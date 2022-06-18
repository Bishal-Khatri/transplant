<?php

namespace Modules\Hospital\Http\Middleware;

use App\Enum\UserType;
use Closure;
use Illuminate\Http\Request;

class Hospital
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

        if (auth()->user()->user_type != UserType::HOSPITAL){
            abort(403);
        }

        // check if user has changed password
        if (auth()->user()->password_change_at == null){
            return redirect(route('change-password'));
        }

        $user = auth()->user();
        $hospital = $user->hospital;
        if (!$hospital OR !$hospital->status){
            abort(403, 'This account has been disabled.');
        }

        return $next($request);
    }
}
