<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;

class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index(Request $request)
        {
            $orders = Order::where('user_id',auth()->user()->id)->get();
            if(is_null($orders)){
                return back();
            } 
            return response()->json($orders);
        } 
        //======================== create order  ======================
        public function store(StoreOrderFront $request)
        {
            Order::insertOrder($request); 
            return response()->json(['message' => 'Order Created Successfully']);
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
            $order=Order::updateOrder($request,$id);
            return response()->json("updated successfully!");
        }
        //======================== delete order  ======================

        public function destroy($id)
        {
            $order = Order::findOrFail($id);
            $order->delete();  
            return response()->json("deleted successfully");
        }
}
