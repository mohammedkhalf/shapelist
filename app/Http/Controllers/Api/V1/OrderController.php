<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;
// use App\Models\Product\Product;
// use App\Models\Template\Template;
// use App\Models\Platform\Platform;
// use App\Models\Addon\Addon;
// use App\Models\Location\Location;
// use App\Models\Coupon\Coupon;
// use App\Models\MusicSample\MusicSample;
// use App\Models\Status\Status;
// use App\Models\Access\User\User;


class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index(Request $request)
        {
            $orders = Order::where('user_id',auth()->user()->id)->get();
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
            return response()->json($order);
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
