<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use App\Http\Requests\Backend\Cart\StoreCartRequest;
use App\Http\Requests\Backend\Cart\UpdateCartRequest;
use App\Models\Order\Order;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Models\Payment\Payment;
use Validator;



class CartController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        if($request->type == "product")
        {
            $ItemData = OrderItem::insertProductItems($request);
        }
        else 
        {
            $ItemData = OrderPackage::insertPackages($request);
        }
        return response()->json(['ItemData'=>$ItemData,'message'=>'Item added Successfully']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->type == "product")
        {
            OrderItem::findOrFail($id)->delete();
        }
        else 
        {
            OrderPackage::findOrFail($id)->delete();
        }
        return response()->json(['message'=>'Item Deleted Successfully']);
    }

     //payment methods
     public static function prepareCheckout(Request $request)
     {
         $total_price = $request->total_price;
         $url = "https://test.oppwa.com/v1/checkouts";
         $data = "entityId=8a8294174d0595bb014d05d82e5b01d2".
                 "&amount=$total_price".
                 "&currency=EUR".
                 "&paymentType=DB";
 
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                         'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
             curl_setopt($ch, CURLOPT_POST, 1);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $responseData = curl_exec($ch);
             if(curl_errno($ch)) {
                 return curl_error($ch);
             }
             curl_close($ch);
             return $responseData;
     } //prepareCheckout

     //post resource id + order data 
    public function resourceOrder (StoreOrderRequest $request)
    {     
        $responseObj = Order::getStatus($request->resource_id);
        $paymentObj = json_decode($responseObj,true);
        if(array_key_exists("id",$paymentObj)  && !empty($paymentObj['id']) ) //id
        {
            $orderObj = Order::CreteOrderRequest($request);
            OrderItem::insertProducts($request,$orderObj);
            Payment::create(['bank_transaction_id'=>$paymentObj['id'] ,'order_id'=> $orderObj->id]);
            Order::sendPdfInvoice($orderObj);
            return response()->json(["description"=>"Request successfully processed"], 200);
        }
        else{
            $responseObj=json_decode($responseObj,true);
            return $responseObj['result']; 
        }  
    }

}
