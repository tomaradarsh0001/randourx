<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plainPassword;

    public function __construct(User $user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

   public function build()
{
    return $this->subject('Registration Successful')
        ->view('emails.registration_success')
        ->with([
            'full_user' => $this->user["full_name"],
            'username' => $this->user["username"],
            'email' => $this->user["email"],
            'plainPassword' => $this->plainPassword,
        ]);
}

}
