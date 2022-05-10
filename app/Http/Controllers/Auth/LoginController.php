<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserType;
use App\Http\Controllers\Controller;
use App\Models\OTPLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\SendSMS;
use App\Traits\SetResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * @return string
     */
    public function redirectTo() {
        $userType = Auth::user()->user_type;
        switch ($userType) {
            case UserType::ADMINISTRATOR:
                return RouteServiceProvider::ADMIN_HOME;
                break;
            case UserType::HOSPITAL:
                return RouteServiceProvider::HOSPITAL_HOME;
                break;

            default:
                return '/';
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'apiLogout', 'updateMyProfile', 'getMyProfile']);
    }

    public function apiPhoneLogin(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'regex:^\+?(?:977)?[ -]?(?:(?:(?:98|97)-?\d{8})|(?:01-?\d{7}))$^']
        ]);

        $user = User::firstOrCreate(
            ["phone_number" => $request->phone_number],
            ["user_type" => 'subscriber']
        );

        // sends OTP SMS and updates user's OTP in o_t_p_logs table
        $otp_response = $this->sendOtpSms($user->phone_number);
        if ($otp_response == 'success'){
            $response = $this->prepareResponse(false, 'OTP sent successfully.', [], []);
        }else{
            $response = $this->prepareResponse(true, 'fail.', [], []);
        }

        return response()->json($response);
    }

    public function apiEmailLogin(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($this->prepareResponse(true, "Validation error.", [], [$validator->errors()]));
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $response = $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
            return $response;
        }

        $this->updateUserData($user, $request);

        $token = $user->createToken($request->device_name)->plainTextToken;

        return $this->sendApiLoginResponse($user, $token);
    }

    public function validateOtp(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'phone_number' => ['required', 'regex:^\+?(?:977)?[ -]?(?:(?:(?:98|97)-?\d{8})|(?:01-?\d{7}))$^'],
            'otp' => ['required'],
            'device_name' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($this->prepareResponse(true, "Validation error.", [], [$validator->errors()]));
        }

        // validate otp
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user){
            return $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
        }
        $otp = OTPLog::where('phone', $user->phone_number)->latest('id')->first();

        if (blank($otp)){
            return response()->json($this->prepareResponse(true, 'OTP not found', [], []));
        }

        if ($otp->otp != $request->otp){
            $response = $this->prepareResponse(true, 'The provided credentials are incorrect.', [], []);
            return $response;
        }

        $this->updateUserData($user, $request);

        $token = $user->createToken($request->device_name)->plainTextToken;

        return $this->sendApiLoginResponse($user, $token);
    }

    private function updateUserData($user, $request)
    {
        $user->os = $request->os;
        $user->api_level = $request->api_level ?? '';
        $user->brand = $request->brand ?? '';
        $user->device = $request->device ?? '';
        $user->model = $request->device_name ?? '';
        $user->product = $request->product ?? '';
        $user->version_code = $request->version_code ?? '';
        $user->version_name = $request->version_name ?? '';
        $user->save();
    }

    private function sendApiLoginResponse(User $user, $token)
    {
        $user->load('addresses', 'addresses.district', 'addresses.street');
        $response = $this->prepareResponse(false, 'Login Success.', compact('token', 'user'), []);
        return response()->json($response);
    }

    public function apiLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = $this->prepareResponse(false, 'Logout Success.', [], []);
        return $response;
    }

    public function getMyProfile()
    {
        $user = auth()->user();
        $user->load('addresses', 'addresses.district', 'addresses.street');
        $response = $this->prepareResponse(false, 'success', compact('user'), []);
        return $response;
    }

    public function updateMyProfile(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//        ]);

        $user = auth()->user();
        $user->name = $request->name;

        if (isset($request->avatar) AND $request->hasFile('avatar')){
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }
        $user->save();

        $response = $this->prepareResponse(false, 'Profile updated successfully.', [], []);
        return $response;
    }
}
