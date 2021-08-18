<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'title' => 'Reset Password',
            'firstname' => $this->user->firstname,
            'token' => $this->token
        ];

        return $this->subject('Reset Password')
            ->markdown('emails.password_reset', $data);
    }
}
