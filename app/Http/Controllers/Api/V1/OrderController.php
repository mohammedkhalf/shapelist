<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Position\Position;
use App\Models\Platform\Platform;
use App\Models\Addon\Addon;
use App\Models\Location\Location;
use App\Models\Coupon\Coupon;
use App\Models\MusicSample\MusicSample;
use App\Models\OrderStatus\OrderStatus;

use App\Models\Access\User\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 //======================== create order  ======================
 public function store($user_id,Request $request)
 {
    //find user
    $user = User::findOrFail($user_id);
    //get product id and price
    $product_id = $request->product_id;
    $myProduct = Product::findOrFail($product_id);
    $product_price = $myProduct->price;
    //get platform id if empty set null
    $platform_id = $request->platform_id;
    $myPlatform = Platform::find($platform_id);
    if(!$myPlatform){
    $platform_id =Null;
    }
    //get position id if empty set null
    $position_id = $request->position_id;
    $myPosition = Position::find($position_id);
    if(!$myPosition){
    $position_id =Null;
    }
    //get music id if empty set null
    $music_id = $request->music_id;
    $myMusic = MusicSample::find($music_id);
    if(!$myMusic){
    $music_id =Null;
    }
    // set defult order status 0->(pending)
    $status_id = 0;
    



return 123;


//     //get addon id
//     $addon_id = Addon::findOrFail($addon_id); 
//     //get coupon id   
//     $coupon_id = Coupon::findOrFail($user_id);
//     ///put default value for status id   
//     $status_id = 1;
//     //get musicSample id   
//     $music_id = MusicSample::findOrFail($user_id);
//     //put default value for payment id   
//     $payment_id = 0;




// //get Location id
// $location_id = Location::findOrFail($location_id);

//  try{
//     if($request->hasFile('logo')){
//         // Get filename with the extension
//         $filenameWithExt = $request->file('logo')->getClientOriginalName();
//         // Get just filename
//         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//         // Get just ext
//         $extension = $request->file('logo')->getClientOriginalExtension();
//         // Filename to store
//         $fileNameToStore= $filename.'_'.time().'.'.$extension;
//         // Upload Image
//         $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
//     } else {
//         $fileNameToStore = 'noimage.jpg';
//     }


//      $order = new Order;
//      $order->user_id= $user_id;
    

//      $order->image= $fileNameToStore;
//      $order->save();
//      return response()->json($order);


//  } catch(\Illuminate\Database\QueryException $e){
//      $errorCode = $e->errorInfo[1];
//      if($errorCode == '1062'){
//          return response()->json("this order is already registered!" );
//      }}
 }
}
