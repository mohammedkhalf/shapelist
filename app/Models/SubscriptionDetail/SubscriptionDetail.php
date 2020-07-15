<?php

namespace App\Models\SubscriptionDetail;
use App\Models\Quotation\Quotation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use App\Models\Access\User\User;
use Carbon\Carbon;
use PDF;

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
    
    protected $casts = [
        'status' => 'boolean',
        'purchase_points' => 'float',
        'free_points' => 'float',
        'discount' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');   
    }  

    public static function getSubscriptionData($subscriber,$subscription)
    {
        $vatPercentage = Quotation::where('name','Vat')->pluck('rate')->first();

        $data = [
            'Invoice_Number' => $subscriber->id,
            'first_name' => auth()->guard('api')->user()->first_name,
            'email'=> auth()->guard('api')->user()->email,
            'phone_number'=> auth()->guard('api')->user()->phone_number,
            'sub_total'=> $subscription->price,
            'vatPercentage' => $vatPercentage,
            'vatValue' => $subscription->price*$vatPercentage/100,
            'total_price' =>$subscription->price*$vatPercentage/100+$subscription->price,
            'date' => $subscriber->updated_at,
            'subject'=> 'Subscription Invoice',
            'subscription_name'=> $subscription->name,
            'purchase_points'=> $subscription->purchase_points,
            'free_points'=> $subscription->free_points,
            'discount'=> $subscription->discount,
            'duration'=> $subscription->duration,


        ];
        return $data;
    }

    public static function changePlane($id,$bankTransactionId)
    {
            $subscription = Subscription::findOrFail($id);
            $duration =  $subscription->duration;
            $newPoints = $subscription->purchase_points;
            $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();

            $newSubscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
            $newSubscriptionDetail->update(['subscription_id'=>$id , 'status'=>1,
            'bank_transaction_id'=>$bankTransactionId,
            'purchase_points'=>$subscription->purchase_points + $oldSubscription->purchase_points  ,
            'free_points'=>$subscription->free_points ,
            'discount'=>$subscription->discount , 'start_date' => Carbon::now()->toDateString() ,
            'end_date' => Carbon::now()->addMonths($duration)->toDateString() ]);
            return $newSubscriptionDetail;
    }

    public static function newSubscription($id,$bankTransactionId)
    {
            $subscription = Subscription::findOrFail($id);
            $duration=$subscription->duration;
            $userDetails = SubscriptionDetail::create(['user_id'=> auth()->guard('api')->user()->id,'subscription_id'=>$id,
            'status'=>1,'purchase_points'=>$subscription->purchase_points ,'free_points'=>$subscription->free_points ,
            'discount'=>$subscription->discount ,'bank_transaction_id'=>$bankTransactionId, 'start_date' => Carbon::now()->toDateString() ,
            'end_date' => Carbon::now()->addMonths($duration)->toDateString() ]);
            return $userDetails;
    }

    public static function updateUserPoints($request)
    {
            $subscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
            $subscriptionDetail->update(['purchase_points'=>$request->purchase,'free_points'=>$request->free]);
            return $subscriptionDetail;     
    }
   
    public static function unsubscribe($id)
    {
            $subscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
            $subscriptionDetail->update(['subscription_id'=>null]);
            return $subscriptionDetail;     
    }
   
    public static function sendInvoicePdf($data)
    {
        $pdf = PDF::loadView('emails.subscription_invoive', $data);
        Mail::send('emails.subscription_invoive',$data,function($message)use($data,$pdf) {
        $message->to($data["email"],$data["first_name"],$data["Invoice_Number"])
        ->subject($data["subject"])
        ->attachData($pdf->output(),"invoice.pdf");
        });  

    }
   
}
