<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriber, $status)
    {
        $this->subscriber = $subscriber;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->status== 1){
            return $this->view('emails.reminder')->with('subscriber', $this->subscriber);
        }
        if($this->status== 2){
            return $this->view('emails.reminder2')->with('subscriber', $this->subscriber);
        }
        if($this->status== 3){
            return $this->view('emails.reminder3')->with('subscriber', $this->subscriber);
        }
    }
}
