<?php

namespace App\Models\Order;
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

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';


    protected $fillable = [
     'product_id','platform_id','addon_id',
        'location_id','music_id','status_id','products_quantity','video_length'
       ,'notes','product_price','template_id'
       ,'image','user_id','coupon_id','product_price','total_price'
    ];
 //====================================== Relationships =======================================
 public function product()
 {
     return $this->belongsTo(Product::class,'Product_id','id');   
 }
//==============================       
 public function template()
 {
     return $this->belongsTo(Template::class,'template_id','id');   
 }
 //==============================
 public function addon()
 {
     return $this->belongsTo(Addon::class,'addon_id','id');   
 }
 //==============================
 public function platform()
 {
     return $this->belongsTo(Platform::class,'platform_id','id');   
 } 
 //==============================
 public function location()
 {
     return $this->belongsTo(Location::class,'location_id','id');   
 } 
 //==============================
 public function coupon()
 {
     return $this->belongsTo(Coupon::class,'coupon_id','id');   
 }  
 //==============================
 public function musicSample()
 {
     return $this->belongsTo(MusicSample::class,'music_id','id');   
 } 
 //==============================
 public function status()
 {
     return $this->belongsTo(Status::class,'status_id','id');   
 }  
//=============================== Insert Order ================================================
    public static function insertOrder($user_id, $request)
    {
           $user = User::findOrFail($user_id);
           $myProduct= Product::findOrFail($request->product_id);
           $myAddon= Addon::findOrFail($request->addon_id);
        //    dd($myAddon['price']); die;
           if($request->hasFile('logo')){
           $filenameWithExt = $request->file('logo')->getClientOriginalName();
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           $extension = $request->file('logo')->getClientOriginalExtension();
           $fileNameToStore= $filename.'_'.time().'.'.$extension;
           $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
           } else {
           $fileNameToStore = null;
           }

            $couponData = Coupon::where('code' , $request->coupon_code)->get();
            foreach($couponData as $CData){ $coupon_id = $CData->id; }
            if(($CData->valid==0)||($CData->quantity <1)||(!is_null($CData)))
            $coupon_id =Null;  $coupon_code =Null; $discount= 0;
           //get coupon id,price if empty set 0=====================  
           if($request->coupon_code !== null && $request->addon_id !== null ) 
           {
                $total_price= (($myProduct['price']*$request->products_quantity)+$myAddon['price'])*(1-($CData->amount/100));
                $data = $request->only('product_id','platform_id','addon_id',
                'location_id','music_id','template_id','video_length','product_quantity'
                ,'notes');
     
                $orderData = array_merge($data ,['product_price'=>$myProduct['price'] ],['total_price'=>$total_price],
                ['coupon_id'=>$coupon_id ],['user_id'=>$user->id],['image' => $fileNameToStore]);

                dd($orderData);
           }
        //    elseif($request->coupon_code){
        //          $total_price= (($myProduct['price']*$request->products_quantity))*(1-($CData->amount/100));
        //    }
        //    elseif($request->addon_id){

        //       $total_price= (($myProduct['price']*$request->products_quantity)+$myAddon['price']);
        //    }
        //    else{
        //     $total_price= $myProduct['price']*$request->products_quantity;
        //    }
      

        try{
          


           $pakageOrder = Order::create($orderData);
           //coupon quantity -1==========================================
           if($CData->amount>0){
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
