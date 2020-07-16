<?php

namespace App\Http\Controllers\Api\V1;

use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
   
    public function index()
    {
        $subscriptions = Subscription::with('delivery')->get()->makeHidden(['created_at','updated_at']);
        return response()->json($subscriptions); 
    }
  
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json($subscription);
    }

    public function subscribe($id,$bankTransactionId)
    { 
                    // this function contains (subscribe + change plan)
                        $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                        if(!$UserSubscription->isEmpty()){   
                                //if the user has old plan
                                $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
                                // upgrade or downgrade the plan or re_subscribe in the same plan
                                $updatedPlan=SubscriptionDetail::changePlane($id,$bankTransactionId); 
                                $subscription =  Subscription::findOrFail($id);
                                $subscriber =  SubscriptionDetail::with('user')->where('id', $updatedPlan->id)->first();
                                //mail
                                Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,5,$subscription->name));
                                //pdf
                                $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                                SubscriptionDetail::sendInvoicePdf($data); 
                                return response()->json(['updatedPlan'=> json_decode($updatedPlan) ,'message' => 'You are Successfully Subscribe to a New Plan..']);            
                                

                        }else{
                                //for new subscription 
                                $subscription =  Subscription::findOrFail($id);
                                $newSubscription=SubscriptionDetail::newSubscription($id,$bankTransactionId);
                                $subscriber =  SubscriptionDetail::with('user')->where('id', $newSubscription->id)->first();
                                //mail
                                Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,4,$subscription->name));
                                //pdf
                                $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                                SubscriptionDetail::sendInvoicePdf($data);
                                return response()->json(['updatedPlan'=> json_decode($newSubscription) ,'message' => 'You are Successfully Subscribe in a New Plan..']);            

                        }

    }

    public function updatePoints(Request $request){
        $userSubscription=SubscriptionDetail::updateUserPoints($request); 
        return $userSubscription ;
    }
  
}