<?php

namespace Modules\Hospital\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LicenseVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $hospital = $user->hospital;
        $license = $hospital->getLicense();
        if($license){
            if($license->expiry_date > Carbon::today()){
                return $next($request);
            }else{
                abort(403, 'Your license has been expired.');
            }
        }
        abort(403, 'License not found.');
    }
}
