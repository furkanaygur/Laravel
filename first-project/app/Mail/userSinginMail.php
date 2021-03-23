<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class userSinginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('furkan.aygur.1@gmail.com')
            ->subject(config('app.name') . ' - User Register')
            ->view('mails.user_register');
    }
}
