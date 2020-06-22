<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Mail\ReminderMail;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;


class subscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will change status to 0 after 14 day! and send email before two days!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
        //=====================================================================
        $today = Carbon::now()->toDateString();
        $inactivateDay = Carbon::parse($user->end_date)->addDays(1)->toDateString();
        $secondReminderDay = Carbon::parse($user->end_date)->subDays(2)->toDateString();
        $thirdRemindDay = Carbon::parse($user->end_date)->addDays(12)->toDateString();
        $activeUse = SubscriptionDetail::with('user')->where('status', 1)->get();
        $inactiveUsers= SubscriptionDetail::with('user')->where('status', 0)->get();
        //==================Reminder at  Day 28  of  Subscription  ===========================
        foreach ($activeUse as $user) 
        {
            if($secondReminderDay == $today){
                $userReminder = SubscriptionDetail::with('user')->where('id', $user->user->id)->get();
                Mail::to($user->user->email)->send(new ReminderMail($user,1));
            } 
        }
        //=====================  Reminder at Day 30 Subscription & change status after 30 day ====================================
        foreach ($activeUse as $user) 
        {
            if($today == $user->end_date){
                Mail::to($user->user->email)->send(new ReminderMail($user,2));
            }
            if($today == $inactivateDay){
                $inactiveUser = subscriptionDetail::where('id', $user->id)->update(array('status' => 0,'bank_transaction_id' => Null));
            }
        }
        //================= Subscription Last Reminder =======================================
        foreach ($inactiveUsers as $user) 
        {
            if($thirdRemindDay == $today){
                Mail::to($user->email)->send(new ReminderMail($user,3));
            }
        }
       //================= delete all points after 14 day =======================================



    }
}
