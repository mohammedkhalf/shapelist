<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;

class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index()
        {
            $allOrders = collect([]);
            $ordersData = Order::with('product','template','addon','platform','location','musicSample','status')
                          ->where('user_id',auth()->guard('api')->user()->id)->get();
            if(is_null($ordersData)){return back();}
            foreach($ordersData as $order){
                $allOrders->push(Order::getOrderData($order));
            }
            return response()->json($allOrders);   
         
        } 
        //======================== create order  ======================
        public function store(StoreOrderFront $request)
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
            $data = Order::getOrderData($order);
            $responseCheckout = Order::prepareCheckout($order->total_price);
            $OrderData = array_merge($data , ['responseCheckout'=>json_decode($responseCheckout)]);
            
            return response()->json($OrderData);
        }
        //======================== update order  ======================

        public function update(StoreOrderFront $request, $id)
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
}
