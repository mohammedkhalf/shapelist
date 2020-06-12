<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index()
        {
            $allOrder = Order::with('products','location')->where('user_id',auth()->guard('api')->user()->id)->get();
            return response()->json(json_decode($allOrder));   
        } 
        //======================== create order  ======================
        public function store(StoreOrderRequest $request)
        {
            $orderInfo=Order::insertOrder($request); 
            return response()->json(['orderInfo'=>$orderInfo ,'message' => 'Order Created Successfully']);
        }
        //======================== show order  ======================

        public function show($id)
        {
            $order = Order::findOrFail($id);
            if(is_null($order)){
                return back();
            } 
            $responseCheckout = Order::prepareCheckout($order->total_price);
            $OrderData = array_merge(['responseCheckout'=>json_decode($responseCheckout)]);
            
            return response()->json($OrderData);
        }
        //======================== update order  ======================

        public function update(UpdateOrderRequest $request, $id)
        {   
            $updatedOrder=Order::updateOrder($request,$id);
            return response()->json(['updatedOrder'=>$updatedOrder ,'message' => 'Order updated successfully!']);
        }
        //======================== delete order  ======================

        public function destroy($id)
        {
            $order = Order::findOrFail($id);
            $order->delete();  
            return response()->json("Order deleted successfully");
        }

        public function getStatus ($checkoutId)
        {
            $responseData = Order::getStatus($checkoutId);
            return response()->json(['responseData'=>json_decode($responseData)]);          
        }

        public function getMedia($id)
        {
            $order = Order::findOrFail($id);
            if($order->download_file)
            {
               return response()->download(storage_path("app/public/orders-download/{$order->download_file}"));
            }
            return response()->json(['message'=>'There Is No Media File']);          
        }

        public function savePaymentInfo(Request $request)
        {
            // 1 payment successs
            if($request->payment_status == 1)
            {           
                $orderObj = Order::findOrFail($request->order_id);
                $orderObj->update($request->only('bank_transaction_id','payment_status'));
                return response()->json(['message'=>'Payment Process Successfully']);
            }
            // Failure
            return response()->json(['message'=>'Payment Process  Failure']);
        }
}
