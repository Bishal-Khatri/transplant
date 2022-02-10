<?php
namespace App\Traits;

use App\Models\OTPLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;

trait SendSMS{

    public function send($phone, $template)
    {
        $token = env('SMS_TOKEN');
        if (!blank($phone) AND !blank($template) AND !blank($token)) {
            $payload = [
                'auth_token' => $token,
                'to' => $phone,
                'text'=> $template
            ];
            return 'success';
//            $apiRequest = Http::post('https://sms.aakashsms.com/sms/v3/send', $payload);
//            $response = json_decode($apiRequest->getBody());
//            if ($response->error === false) {
//                return 'success';
//            }
        }
        return 'fail';
    }

    public function sendOtpSms($phone)
    {
        $otp = 1234;
        $otp_template = SmsTemplate::where('key', 'otp')->first();
        if (!blank($otp_template)){
            $replace = array(
                '@{otp}' => $otp,
            );
            $template = str_replace(array_keys($replace), array_values($replace), $otp_template->template);
            // send sms
            $result = $this->send($phone, $template);

            if ($result == 'success'){
                OTPLog::create([
                    'phone' => $phone,
                    'otp' => $otp
                ]);

                return 'success';
            }
        }
        return 'fail';
    }

}
