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
        //the plan
        $subscription =  Subscription::findOrFail($id);        
                if(array_key_exists("id",$paymentObj)  && !empty($paymentObj['id']) ) //id
                {
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
                    $responseObj=json_decode($responseObj,true);
                    return response()->json($responseObj['result'],422);
                    
                }
           

    }

    public function updatePoints(Request $request){
        $userSubscription=SubscriptionDetail::updateUserPoints($request); 
        return $userSubscription;
    }

    public function subscriptionPrepareCheckout(Request $request)
     {
        //the plan 
        $subscription =  Subscription::findOrFail($request->$id);
        $planPrice = number_format($subscription->price,2, '.', '');
        $totalPrice = number_format($request->total_price,2, '.', '');
        // Check if plan price equals total price

         if($planPrice == $totalPrice){
                $url = "https://test.oppwa.com/v1/checkouts"; //Protect this
                $data = "entityId=8a8294174d0595bb014d05d82e5b01d2".//Protect this
                        "&amount=$totalPrice".
                        "&currency=EUR".//Protect this
                        "&paymentType=DB";
    
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));//Protect this
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production  //Protect this
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $responseData = curl_exec($ch);
                if(curl_errno($ch)) {
                    return curl_error($ch);
                }
                curl_close($ch);
                
                $checkoutObject = json_decode($responseData,true);
                if(array_key_exists("id",$checkoutObject))
                {
                    return $responseData;
                }
                return response()->json(["description"=>$checkoutObject['result']['description']], 422);

            }else{
                return response()->json(['error'=>'amount missmatch'],422);            
            }

     } //prepareCheckout
  
}