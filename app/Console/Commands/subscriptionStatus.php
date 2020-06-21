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
        $date = Carbon::now()->toDateString();
        $subscriptionDetail = subscriptionDetail::where('end_date',$date)->update(array('status' => 0));
        // send email before two days
        $remiderDay = Carbon::now()->subDays(2)->toDateString();
        $userReminder = SubscriptionDetail::with('user')->where('status', 1)->where( 'end_date', $remiderDay)->get();

        foreach ($userReminder as $subscribInfo) {
            Mail::to($subscribInfo->user->email)->send(new ReminderMail());
        }
        
            
    }
}
