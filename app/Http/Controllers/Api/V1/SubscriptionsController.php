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

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
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
