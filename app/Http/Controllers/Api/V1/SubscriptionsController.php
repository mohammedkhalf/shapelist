<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subscription\Subscription;
use App\Models\SubscriptionDetail\SubscriptionDetail;

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
        
        $subscription = Subscription::findOrFail($id);
        // $userSubscriptionDetails = SubscriptionDetail::create($subscription);

        // return  auth()->guard('api')->user()->id;
        return $subscription;
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
