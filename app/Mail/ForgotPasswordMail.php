<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newPassword;

    public function __construct($user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Your New Password - Randourx')
                    ->view('emails.forgot_password')
                    ->with([
                          'full_user' => $this->user["full_name"],
                        'username' => $this->user["username"],
                        'email' => $this->user["email"],
                        'newPassword' => $this->newPassword,
                    ]);
    }
}
