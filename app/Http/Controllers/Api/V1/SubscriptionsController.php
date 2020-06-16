<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
   
    public function index()
    {
        $subscriptions = Subscription::all();
        return response()->json($subscriptions); 
    }
  
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json($subscription);
    }

    public function subscribe($id)
    {
            try{
                    if($id != 0){
                            $subscription = Subscription::findOrFail($id);
                            $duration=$subscription->duration;

                            $userDetails = SubscriptionDetail::create(['user_id'=> auth()->guard('api')->user()->id,'subscription_id'=>$id,
                            'status'=>1,'purchase_points'=>$subscription->purchase_points ,'free_points'=>$subscription->free_points ,
                            'discount'=>$subscription->discount , 'start_date' => Carbon::now()->toDateString() ,
                            'end_date' => Carbon::now()->addMonths($duration)->toDateString() ]);

                            
                            // $bank_transaction_id 

                            return response()->json($userDetails);
                    }if($id == 0){

                        $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                            if(!$UserSubscription->isEmpty()){
                                $subscriptionDetail = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
                                $subscriptionDetail->update(['subscription_id'=>null]);
                                return response()->json($subscriptionDetail);
                             }else{
                                return response()->json("you are not subscribe to this plan..!");  
                             }
                    }
                  



                        
            }catch(\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == '1062'){
                        return response()->json("you are already subscribe in this plan!");
                    }
            }
    }

    public function unsubscribe($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
