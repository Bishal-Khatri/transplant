<?php
namespace App\Traits;

use App\Mail\LoginCredential;
use App\Models\OTPLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

trait SendEmail{

    public function basic_email($to, $data)
    {
        Mail::to($to)->send(new LoginCredential($data));
        return 'success';
    }
}
