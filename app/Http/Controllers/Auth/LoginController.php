<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTPLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\SendSMS;
use App\Traits\SetResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, SetResponse, SendSMS;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'apiLogout']);
    }

    public function apiEmailLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $response = $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
            return $response;
        }
        $token = $user->createToken($request->device_name)->plainTextToken;
        $response = $this->prepareResponse(false, 'Login Success.', ["token" => $token], []);
        return $response;
    }

    public function apiPhoneLogin(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'regex:^\+?(?:977)?[ -]?(?:(?:(?:98|97)-?\d{8})|(?:01-?\d{7}))$^']
        ]);

        $user = User::firstOrCreate(
            ["phone_number" => $request->phone_number]
        );

        // sends OTP SMS and updates user's OTP in o_t_p_logs table
        $this->sendOtpSms($user->phone_number);

        $response = $this->prepareResponse(false, 'OTP sent successfully.', [], []);
        return $response;
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'regex:^\+?(?:977)?[ -]?(?:(?:(?:98|97)-?\d{8})|(?:01-?\d{7}))$^'],
            'otp' => ['required'],
            'device_name' => ['required']
        ]);

        // validate otp
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user){
            return $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
        }
        $otp = OTPLog::where('phone', $user->phone_number)->latest('id')->first();
        if ($otp->otp != $request->otp){
            $response = $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
            return $response;
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        $response = $this->prepareResponse(false, 'Login Success.', ["token" => $token], []);
        return $response;
    }

    public function apiLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = $this->prepareResponse(false, 'Logout Success.', [], []);
        return $response;
    }
}
