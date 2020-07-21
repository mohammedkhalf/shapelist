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
    public function __construct($subscriber, $status ,$subscriptionName)
    {
        $this->subscriber = $subscriber;
        $this->status = $status;
        $this->subscriptionName = $subscriptionName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->status== 1){//Reminder at  Day 28  of  Subscription
            return $this->view('emails.reminder')->with('subscriber', $this->subscriber);
        }
        if($this->status== 2){// Reminder at Day 30 Subscription
            return $this->view('emails.second_reminder')->with('subscriber', $this->subscriber);
        }
        if($this->status== 3){//Subscription Last Reminder
            return $this->view('emails.third_reminder')->with('subscriber', $this->subscriber);
        }
        if($this->status== 4){//New Subscription Reminder
            return $this->subject('Subscription Mail')->view('emails.newSubscription')->with(array('subscriber'=> $this->subscriber ,'subscriptionName'=>$this->subscriptionName ));
        }
        if($this->status== 5){//Renew Subscription Reminder
            return $this->subject('Subscription Mail')->view('emails.renewSubscription')->with(array('subscriber'=> $this->subscriber ,'subscriptionName'=>$this->subscriptionName ));
        }
    }
}
