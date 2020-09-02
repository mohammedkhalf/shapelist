<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class UserNeedsConfirmation.
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $user;

    /**
     * UserNeedsConfirmation constructor.
     *
     * @param $confirmation_code
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param \App\Models\Access\User\User $user
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($user)
    {
        
        // $url = url('https://www.shapelist.com');
        // return (new MailMessage())
        // ->view('emails.user-confirmation', ['confirmation_url' => $url, 'user'=>$user ] );
        // app('App\Repositories\Frontend\Access\User\UserRepository')->confirmAccount( $user->confirmation_code);
         //redirect to Home Page
         $confirmation_url = route('frontend.auth.account.confirm', $user->confirmation_code);
         return (new MailMessage())
        ->view('emails.user-confirmation', ['confirmation_url' => $confirmation_url, 'user'=>$user ] );
    }
}
