<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserType;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showChangePassword()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->password_change_at = Carbon::now();
        $user->save();

        session()->flash('success', 'Success <br> Password Changed successfully.');
        $userType = $user->user_type;
        switch ($userType) {
            case UserType::ADMINISTRATOR:
                return redirect(RouteServiceProvider::ADMIN_HOME);
                break;
            case UserType::HOSPITAL:
                return redirect(RouteServiceProvider::HOSPITAL_HOME);
                break;

            default:
                return '/';
                break;
        }
    }

}
