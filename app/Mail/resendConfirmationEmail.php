<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class resendConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
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
        // $confirmation_url = route('frontend.auth.account.confirm', $this->user->confirmation_code);
        // return $this->view('emails.user-confirmation')->with(array('confirmation_url'=> $confirmation_url ,'user'=>$this->user ));

        $url = url('https://www.shapelist.com');
        $this->view('emails.user-confirmation', ['confirmation_url' => $url, 'user'=>$this->user] );
        app('App\Repositories\Frontend\Access\User\UserRepository')->confirmAccount($this->user->confirmation_code);
    }
}
