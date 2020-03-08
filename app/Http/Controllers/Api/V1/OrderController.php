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
    //find user======================================
    $user = User::findOrFail($user_id);
    //get product id,price,quantity================== 
    $product_id = $request->product_id;
    $myProduct = Product::findOrFail($product_id);
    $product_price = $myProduct->price;
    $products_quantity = $request->products_quantity;
    //get platform id if empty set null==============
    $platform_id = $request->platform_id;
    $myPlatform = Platform::find($platform_id);
    if(!$myPlatform){
    $platform_id =Null;
    }
    //get template id if empty set null===============
    $template_id = $request->template_id;
    $myTemplate = Template::find($template_id);
    if(!$myTemplate){
    $template_id =Null;
    }
    //get music id if empty set null====================
    $music_id = $request->music_id;
    $myMusic = MusicSample::find($music_id);
    if(!$myMusic){
    $music_id =Null;
    }
    //get logo of order if empty set null===============
    if($request->hasFile('logo')){
     // Get filename with the extension
    $filenameWithExt = $request->file('logo')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
     // Get just ext
     $extension = $request->file('logo')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
    } else {
    $fileNameToStore = null;
    }
    // set defult order status 1->(pending)==============
    $status_id = 1;
    // get vedio lenght if  empty set null================
    $video_length = $request->video_length;
    if(!$video_length){
    $video_length =Null;
        }
    // get notes if  empty set null========================
    $notes = $request->notes;
    if(!$notes){
    $notes =Null;
    }
    //get addon id,price if empty set 0=====================
    $addon_id = $request->addon_id;
    $Myaddon= Addon::find($addon_id);
    if(!$Myaddon){
        $addon_id =Null;
        $addonPrice =0;
        }else{
        $addonPrice= $Myaddon->price;
        }
    //get coupon id,price if empty set 0=====================   
    $coupon_code = $request->coupon_code;
    $MyCoupon= Coupon::where('code',$coupon_code)->get();
    $coupon_id= Coupon::where('code',$coupon_code)->value('id');
    $validity= Coupon::where('code',$coupon_code)->value('valid');
    $discount= Coupon::where('code',$coupon_code)->value('amount');
    $quantity= Coupon::where('code',$coupon_code)->value('quantity');
    if(($validity==0)||($quantity<1)||(!$MyCoupon)){
        $coupon_id =Null;
        $coupon_code =Null;
        $discount= 0;
    }
   //put default value for payment id===========================   
    $payment_id = 0;
   //get Location id============================================
   $location_id = $request->location_id;
   $myLocation = Location::find($location_id);
   if(!$myLocation){
    $location_id =Null;
    }
    //calculate total_price ====================================
    $total_price1= (($product_price*$products_quantity)+$addonPrice);
    $discountValue= $discount/100;
    $total_price= $total_price1*(1-$discountValue);

 try{
    
    $data = $request->only('product_id','platform_id','addon_id',
    'location_id','music_id','status_id','products_quantity','video_length'
    ,'notes');
    $orderData = array_merge($data ,['total_price'=>$total_price],['product_price'=>$product_price],['status_id'=>$status_id],['coupon_id'=>$coupon_id],['user_id'=>$user_id],['image' => $fileNameToStore]);
    $pakageOrder = Order::create($orderData);
    //coupon quantity -1==========================================
    if($discount>0){
    $newQuantity =$quantity-1;
    $coupon = Coupon::find($coupon_id);
    $coupon->quantity= $newQuantity;
    $coupon->save();
    }
    return $pakageOrder;   
 } catch(\Illuminate\Database\QueryException $e){
     $errorCode = $e->errorInfo[1];
     if($errorCode == '1062'){
         return response()->json("invalid!" );
     }}



 }
}
