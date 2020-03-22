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
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\OrderAttribute;
use App\Models\Order\Traits\OrderRelationship;
use Storage;
class Order extends Model
{
    use ModelTrait,
        OrderAttribute,
    	OrderRelationship {
            // OrderAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'orders';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['user_id','product_id','platform_id','addon_id',
    'music_id','status_id','template_id','payment_status','coupon_code','product_quantity',
    'total_price','logo','video_length','notes'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');   
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');   
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
        return $this->hasOne(Location::class,'order_id');   
    } 
   
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
          global $fileNameToStore;

            if($request->hasFile('logo'))
            {
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
            }

            $productPrice= Product::findOrFail($request->product_id)->price;
            if($request->coupon_code){
            $coupon = Coupon::where('code','=',$request->coupon_code)->first();
                if ($coupon->valid == 1){$couponAmount=$coupon->amount;}
                else{echo("invaild coupon code!"); die;}
            }
            if($request->addon_id){
                $priceInfo=Addon::findOrFail($request->addon_id)->price;
            }
            $total_price = ( ($productPrice*$request->product_quantity) + $priceInfo ) * (1-($couponAmount/100) );
            $data = $request->only('product_id','platform_id','addon_id','music_id','template_id','coupon_code',
            'notes','video_length','product_quantity');
            $OrderInfo = array_merge($data , ['total_price'=> $total_price ,'logo'=>$fileNameToStore ,'user_id'=>auth()->guard('api')->user()->id]);
            $OrderData = Order::create($OrderInfo);
            if($request->city || $request->countery || $request->address || $request->lat || $request->long){
                Location::create([
                    'country'=>$request->country 
                    ,'city'=>$request->city,
                    'address'=>$request->address,
                    'lat'=>$request->lat,
                    'lng'=>$request->long, 'order_id' => $OrderData->id,'user_id' => auth()->guard('api')->user()->id]);
             }
            return $OrderData;
        
    }

    //=============================== update Order ================================================
    public static function updateOrder($request,$id)
    {
        global $priceInfo;
        global  $couponAmount;
        global $fileNameToStore;

        $order = Order::findOrFail($id);
        $productPrice= Product::findOrFail($order->product_id)->price;
        if($request->coupon_code){
        $coupon = Coupon::where('code','=',$request->coupon_code)->first();
            if ($coupon->valid == 1){
            $couponAmount=$coupon->amount;
            }else{echo("invaild coupon code!"); die;}
        }
        if($request->addon_id){
            $priceInfo=Addon::findOrFail($request->addon_id)->price;
        }
        if($request->hasFile('logo')){
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
        }
       
        $total_price = ( ($productPrice*$request->product_quantity) + $priceInfo ) * (1-($couponAmount/100) );  
        $updateData = $request->only('product_id','platform_id','addon_id','music_id','template_id','coupon_code',
            'notes','video_length','product_quantity');
        $updateOrder = array_merge($updateData ,  ['total_price'=> $total_price ,'logo' => $fileNameToStore]);
        $order->update($updateOrder);
        if($request->city || $request->countery || $request->address || $request->lat || $request->long){
            Location::create(['country'=>$request->country ,'city'=>$request->city,'address'=>$request->address,
            'lat'=>$request->lat,'lng'=>$request->long, 'order_id' =>  $order->id,'user_id' => auth()->guard('api')->user()->id]);
        }
    }

    public static function getOrderData($order)
    {
        /** template **/
        $tempInfo = !empty($order->template) ? $order->template->image : 'asd.png';
        $tempLink = Storage::disk('public')->url('templates/'.$tempInfo);
        
        /** music **/
        $musicInfo = !empty($order->musicSample) ? $order->musicSample->url : 'asd.mp3';
        $musicLink = Storage::disk('public')->url('smaples/'.$musicInfo);
        
        /** logo **/
        $logoInfo = !empty($order->logo) ? $order->logo : 'asd.png';
        $logoLink = Storage::disk('public')->url('order_logo/'.$logoInfo);

        
        $data = [
            'orderID' => $order->id,
            'firstName' => $order->users->first_name,
            'lastName' => $order->users->last_name,
            'email' => $order->users->email,
            'phoneNumber' => !empty($order->users->phone_number) ? $order->users->phone_number : 'There is No Phone Number',
            'product' =>$order->product->name,
            'platform' => !empty($order->platform) ?  $order->platform->name : 'There is No Platform' ,
            'addon' => !empty($order->addon) ? $order->addon->name : 'There is No Addon',
            
            'template' =>  '<img src='.$tempLink.' border="0" width="100" class="img-rounded" align="center" />',
            
            'music' => '<audio controls style="height:54px;" ><source src='.$musicLink.' ></audio></td>' ,
            
            'logo' => '<img src='.$logoLink.' border="0" width="50" class="img-rounded" align="center" />',
            
            'couponCode' =>  !empty($order->coupon_code) ? $order->coupon_code : 'There is No Coupon Code',
            'productQuantity' => $order->product_quantity,
            'totalPrice' => $order->total_price,
            'videoLength' => $order->video_length,
            'OrderStatus' => !empty($order->status) ? $order->status->type : '',
            'Payment' => $order->payment_status == null ? "Not-Pay" : "Payment-Done",
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
        ];
        return $data;
    }

    public static function prepareCheckout($price)
    {
        $url = "https://test.oppwa.com/v1/checkouts";
	    $data = "entityId=8a8294174d0595bb014d05d82e5b01d2".
                "&amount=$price".
                "&currency=EUR".
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



}