<?php

namespace App\Http\Controllers\Api\V1;

use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

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




    public function subscribe($id)
    { // this function contains (subscribe + unsubscribe + change plan)
              
                    if($id != 0){

                        $UserSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->get();
                        if(!$UserSubscription->isEmpty()){   
                              //for change subscription plan
                              $oldSubscription = SubscriptionDetail::where('user_id',auth()->guard('api')->user()->id)->first();
                                if(($oldSubscription->subscription_id ==$id) &&( $oldSubscription->status !=0)){
                                  //if you already subscribe in the plan..
                                  return response()->json("you are already subscribe in this plan!");
                                  
                                }else{
                                  // upgrade or downgrade the plan 
                                  $updatedPlan=SubscriptionDetail::changePlane($id); 
                                  $subscription =  Subscription::findOrFail($id);
                                  $subscriber =  SubscriptionDetail::with('user')->where('id', $updatedPlan->id)->first();
                                  //payment
                                  $responseCheckout = SubscriptionDetail::prepareCheckout($subscription->price);
                                  //mail
                                  Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,5,$subscription->name));
                                  //pdf
                                  $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                                  $pdf = PDF::loadView('emails.subscription_invoive', $data);
                                  Mail::send('emails.subscription_invoive',$data,function($message)use($data,$pdf) {
                                      $message->to($data["email"],$data["first_name"],$data["Invoice_Number"])
                                              ->subject($data["subject"])
                                              ->attachData($pdf->output(),"invoice.pdf");
                                  });  
                                  return response()->json(['updatedPlan'=> json_decode($updatedPlan) ,'message' => 'You are Successfully Subscribe to a New Plan..']);            
                                }

                        }else{
                             //for new subscription 
                             $subscription =  Subscription::findOrFail($id);
                             $newSubscription=SubscriptionDetail::newSubscription($id);
                             $subscriber =  SubscriptionDetail::with('user')->where('id', $newSubscription->id)->first();
                             //payment
                             $responseCheckout = SubscriptionDetail::prepareCheckout($subscription->price);
                             //mail
                             Mail::to($subscriber->user->email)->send(new ReminderMail($subscriber,4,$subscription->name));
                             //pdf
                             $data = SubscriptionDetail::getSubscriptionData($subscriber,$subscription);
                             $pdf = PDF::loadView('emails.subscription_invoive', $data);
                             Mail::send('emails.subscription_invoive',$data,function($message)use($data,$pdf) {
                                  $message->to($data["email"],$data["first_name"],$data["Invoice_Number"])
                                          ->subject($data["subject"])
                                          ->attachData($pdf->output(),"invoice.pdf");
                              });  
                              return response()->json(['newSubscription'=> json_decode($newSubscription) ,'message' => 'You are Successfully Subscribe in a New Plan..']);            

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
