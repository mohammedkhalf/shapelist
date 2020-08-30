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

    public function subscribe($id,$resource_id)
    { 
        //payment
        $responseObj = SubscriptionDetail::getStatus($resource_id);
        $paymentObj = json_decode($responseObj,true);
        $paymentObj['amount'] =number_format($paymentObj['amount'],2, '.', '');
        //the plan
        $subscription =  Subscription::findOrFail($id);
        $planPrice= number_format($subscription->price,2, '.', '');
        
                if(array_key_exists("id",$paymentObj)  && !empty($paymentObj['id']) ) //id
                {
                    if($paymentObj['amount']==$planPrice){
                            // this function contains (subscribe + change plan)
                                $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                                if(!$UserSubscription->isEmpty()){ 
                                        
                                        //if the user has old plan
                                        $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();                               
                                        //check if user already subscribe in this plan 
                                        $oldPlan = SubscriptionDetail::oldPlan($oldSubscription ,$id); 
                                        switch($oldPlan){
                                            case(true):
                                            // upgrade or downgrade the plan or re_subscribe in the same plan
                                            $updatedPlan=SubscriptionDetail::changePlane($id,$paymentObj['id']); 
                                        
                                            $subscriber =  SubscriptionDetail::with('user')->where('id', $updatedPlan->id)->first();
                                            //mail
                                            Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,5,$subscription->name));
                                            //pdf
                                            $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                                            SubscriptionDetail::sendInvoicePdf($data); 
                                            return response()->json(['updatedPlan'=> json_decode($updatedPlan) ,'message' => 'You are Successfully Subscribe to a New Plan..']); 
                                            break;

                                            case(false):
                                                return response()->json("you are already subscriber in this plan..!",403); 
                                            break;
                                            }
                                }else{
                                        //for new subscription 
                                        $newSubscription=SubscriptionDetail::newSubscription($id,$paymentObj['id']);
                                        $subscriber =  SubscriptionDetail::with('user')->where('id', $newSubscription->id)->first();
                                        //mail
                                        Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,4,$subscription->name));
                                        //pdf
                                        $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                                        SubscriptionDetail::sendInvoicePdf($data);
                                        return response()->json(['updatedPlan'=> json_decode($newSubscription) ,'message' => 'You are Successfully Subscribe in a New Plan..']);            
                                
                                    } 
                        }else{
                         return response()->json(['error'=>'amount missmatch'],422);            
                        }
                }else{
                    $responseObj=json_decode($responseObj,true);
                    return response()->json($responseObj['result'],422);
                    
                }
           

    }

    public function updatePoints(Request $request){
        $userSubscription=SubscriptionDetail::updateUserPoints($request); 
        return $userSubscription;
    }
  
}