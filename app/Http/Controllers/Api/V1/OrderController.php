<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Template\Template;
use App\Models\Platform\Platform;
use App\Models\Addon\Addon;
use App\Models\Location\Location;
use App\Models\Coupon\Coupon;
use App\Models\MusicSample\MusicSample;
use App\Models\Status\Status;
use App\Models\Access\User\User;
use Illuminate\Http\Request;


class OrderController extends APIController
{
    
 //======================== index orders  ======================
 public function index($user_id)
{
     $orders = Order::where('user_id',$user_id)->get();
     return response()->json($orders);
} 
 //======================== create order  ======================
 public function store($user_id,Request $request)
 {
    Order::insertOrder($user_id, $request); 
 }
 //======================== show order  ======================

public function show($user_id ,$id)
{
    $order = Order::findOrFail($id);
    return response()->json($order);
}
//======================== update order  ======================

public function update($user_id,Request $request, $id)
{
    $order = Order::findOrFail($id);
     return response()->json($order);
 }
 //======================== delete order  ======================

public function destroy($user_id ,$id)
{
$order = Order::findOrFail($id);
$order->delete();  
return response()->json("deleted successfully");

}
}
