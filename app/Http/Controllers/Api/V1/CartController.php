<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use App\Http\Requests\Backend\Cart\StoreCartRequest;
use App\Http\Requests\Backend\Cart\UpdateCartRequest;


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
            $ItemData=OrderItem::insertProductItems($request);
        }
        else 
        {
            $ItemData=OrderPackage::insertPackages($request);
        }
        return response()->json(['ItemData'=>json_decode($ItemData),'message'=>'Item added Successfully']);
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
        if($request->type == "product")
        {
            $updated_Item = OrderItem::updateProductItems($request,$id);
        }
        else{
            $updated_Item = OrderPackage::updatePackageItems($request,$id);
        }
        return response()->json(['ItemData'=>json_decode($updated_Item),'message'=>'Item update Successfully']);
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
                 "&currency=SAR".
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

      //get Payment Status Object Using Checkout Id
      public static function getStatus($checkoutId)
      {             
              $url = "https://test.oppwa.com/v1/checkouts/{$checkoutId}/payment";
              $url .= "?entityId=8a8294174d0595bb014d05d82e5b01d2";
  
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                          'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $responseData = curl_exec($ch);
              if(curl_errno($ch)) {
                  return curl_error($ch);
              }
              curl_close($ch);
              return $responseData;
      }

}
