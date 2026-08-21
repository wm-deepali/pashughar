<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $purpose;   // e.g. "login", "signup", "ad posting"
    public $validMinutes;

    /**
     * @param string|int $otp
     * @param string $purpose  Short human-readable reason shown in the email body
     * @param int $validMinutes
     */
    public function __construct($otp, $purpose = 'verify your account', $validMinutes = 10)
    {
        $this->otp = $otp;
        $this->purpose = $purpose;
        $this->validMinutes = $validMinutes;
    }

    public function build()
    {
        return $this->subject('Your OTP Code - Pashughar')
            ->view('email.otp-mail');
    }
}