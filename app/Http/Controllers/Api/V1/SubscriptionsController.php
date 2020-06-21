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
    { // this function contains (subscribe + unsubscribe + change plan)
              
                    if($id != 0){

                        $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                        if(!$UserSubscription->isEmpty()){   
                              //for change subscription plan
                              $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
                                if(($oldSubscription->subscription_id ==$id )){
                                  //if you already subscribe in the plan..
                                        return response()->json("you are already subscribe in this plan!");
                                  
                                }else{
                                  // upgrade or downgrade the plan 
                                  $updatedPlan=SubscriptionDetail::changePlane($id); 
                                  return response()->json(['updatedPlan'=> json_decode($updatedPlan) ,'message' => 'You are Successfully Subscripe to a New Plan..']);            
       
                                }

                        }else{
                             //for new subscription 
                             $newSubscription=SubscriptionDetail::newSubscription($id); 
                             return response()->json(['newSubscription'=> json_decode($newSubscription) ,'message' => 'You are Successfully Subscripe in a New Plan..']);            

                        }

                    }
                    if($id == 0){
                        //for unsubscribe
                        $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                        if(!$UserSubscription->isEmpty()){
                            $userSubscription=SubscriptionDetail::unsubscribe($id); 
                            return response()->json(['userSubscription'=> json_decode($userSubscription) ,'message' => 'You are Successfully Unsubscribe']);            
                        }else{
                            return response()->json("you are not subscribe in any plan...!");  
                        }
                    }

    }

  
}
