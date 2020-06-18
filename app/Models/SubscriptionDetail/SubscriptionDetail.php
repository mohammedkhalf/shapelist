<?php

namespace App\Models\SubscriptionDetail;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use App\Models\Access\User\User;
use Carbon\Carbon;

class SubscriptionDetail extends Model
{
    //
    protected $table = 'subscription_details';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['user_id','subscription_id','status','purchase_points','free_points','discount','start_date',
    'end_date','bank_transaction_id'

    ];
  
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');   
    }  


    public static function changePlane($id)
    {
            $subscription = Subscription::findOrFail($id);
            $duration =  $subscription->duration;
            $newPoints = $subscription->purchase_points;
            $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();

            $newSubscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
            $newSubscriptionDetail->update(['subscription_id'=>$id , 'status'=>1,
            'purchase_points'=>$subscription->purchase_points + $oldSubscription->purchase_points  ,
            'free_points'=>$subscription->free_points ,
            'discount'=>$subscription->discount , 'start_date' => Carbon::now()->toDateString() ,
            'end_date' => Carbon::now()->addMonths($duration)->toDateString() ]);
            return $newSubscriptionDetail;
    }

    public static function newSubscription($id)
    {
            $subscription = Subscription::findOrFail($id);
            $duration=$subscription->duration;
            $userDetails = SubscriptionDetail::create(['user_id'=> auth()->guard('api')->user()->id,'subscription_id'=>$id,
            'status'=>1,'purchase_points'=>$subscription->purchase_points ,'free_points'=>$subscription->free_points ,
            'discount'=>$subscription->discount , 'start_date' => Carbon::now()->toDateString() ,
            'end_date' => Carbon::now()->addMonths($duration)->toDateString() ]);
            return $userDetails;
    }
   
    public static function unsubscribe($id)
    {
            $subscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
            $subscriptionDetail->update(['subscription_id'=>null]);
            return $subscriptionDetail;     
    }
   


}
