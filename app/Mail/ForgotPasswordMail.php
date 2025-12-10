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
    // Use the exact filename that exists in your views/emails folder
    return $this->to($this->user->email)
                ->subject('Password Reset Request - bitlom.io')
                ->view('emails.forgot_password') // or 'emails.forgot-password'
                ->with([
                    'user' => $this->user,
                      'full_user' => $this->user["full_name"],
                      'username' => $this->user["username"],
                      'email' => $this->user["email"],
                      'newPassword' => $this->newPassword,
                ]);
}
}
