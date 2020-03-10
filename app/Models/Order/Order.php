<?php

namespace App\Models\Order;
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
        'music_id','status_id','products_quantity','video_length'
       ,'notes','product_price','template_id'
       ,'logo','user_id','coupon_code','product_price','total_price'
    ];
 //====================================== Relationships =======================================
 public function users()
 {
     return $this->belongsTo(User::class,'user_id','id');   
 }
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
     return $this->hasMany(Location::class,'user_id','id');   
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
    public static function insertOrder($request)
    {
        global $priceInfo;
        global  $couponAmount;

        if($request->hasFile('logo')){
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);}

        $productPrice= Product::findOrFail($request->product_id)->price;
        if($request->coupon_code){
           $coupon = Coupon::where('code','=',$request->coupon_code)->first();
            if ($coupon->valid == 1){
            $couponAmount=$coupon->amount;
            }else{echo("invaild coupon code!"); die;}}
        if($request->addon_id){
            $priceInfo=Addon::findOrFail($request->addon_id)->price;
        }
        if($request->city || $request->countery || $request->address || $request->lat || $request->long){
            Location::create(['country'=>$request->countery  ,'city'=>$request->city,'address'=>$request->address,
            'lat'=>$request->lat,'lng'=>$request->long,'user_id' => auth()->guard('api')->user()->id]);
        }
        $total_price = ( ($productPrice*$request->product_quantity) + $priceInfo ) * (1-($couponAmount/100) );

        $data = $request->only('product_id','platform_id','addon_id','music_id','template_id','coupon_code',
        'notes','video_length','product_quantity');
        $OrderInfo = array_merge($data , ['total_price'=> $total_price ,'logo' =>$fileNameToStore ,'user_id'=>auth()->guard('api')->user()->id]);
        return $OrderInfo;
    }

}
