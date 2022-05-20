<?php

namespace Modules\Hospital\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LicenseVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        dd($user);
//        $license = $user->getLicense();
        return $next($request);
    }
}
