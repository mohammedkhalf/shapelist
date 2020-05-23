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
use App\Models\Promotion\Promotion;

class Order extends Model
{
    use ModelTrait,
        OrderAttribute,
    	OrderRelationship {
            // OrderAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $table = 'orders';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['user_id','product_id','platform_id','addon_id',
    'music_id','status_id','template_id','payment_status','coupon_code','product_quantity',
    'total_price','logo','video_length','notes','background','background_color','delivery_id','user_music','download_file'];

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

    public function promotions()
    {
        return $this->hasMany(Promotion::class,'order_id','id');   
    }  

    //=============================== Insert Order ================================================
    public static function insertOrder($request)
    {      
            global $fileNameToStore;
            global $userMusic;
            if($request->hasFile('logo'))
            {
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
            }
            if($request->hasFile('user_music'))
            {
                $filenameWithExt = $request->file('user_music')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('user_music')->getClientOriginalExtension();
                $userMusic= $filename.'_'.time().'.'.$extension;
                $path = $request->file('user_music')->storeAs('public/users_music', $userMusic);
            }
            
            $productPrice= Product::findOrFail($request->product_id)->price;
            if($request->coupon_code)
            {
                $coupon = Coupon::where('code','=',$request->coupon_code)->first();
                $discount = ($productPrice * $request->product_quantity) * ($coupon->amount / 100);
                $total_price = ($productPrice * $request->product_quantity)-($discount);
            }
            else{
                $total_price = ($productPrice * $request->product_quantity);
            }
            $data = $request->only('product_id','platform_id','music_id','template_id',
            'notes','video_length','product_quantity','background','background_color','delivery_id','user_music');
            $OrderInfo = array_merge($data , ['total_price'=> $total_price ,
            'logo'=>$fileNameToStore ,'user_id'=>auth()->guard('api')->user()->id,'user_music'=>$userMusic]);
            $OrderData = Order::create($OrderInfo);
            if($request->city || $request->countery || $request->address || $request->lat || $request->lng || $request->rep_first_name || $request->rep_last_name || $request->rep_phone_number)
            {
                $locationData = $request->only('country','city','address','lat','lng','rep_first_name','rep_last_name','rep_phone_number');
                $locationInfo = array_merge($locationData,['order_id' => $OrderData->id,'user_id' => auth()->guard('api')->user()->id]);
                Location::create($locationInfo);
            }
            
            return $OrderData;
    }

    //=============================== update Order ================================================
    public static function updateOrder($request,$id)
    {
        global $fileNameToStore;
        global $userMusic;
        global $orderDownload;
        
        $order = Order::findOrFail($id);
        $location = Location::where('order_id','=', $order->id)->first();

        if($request->hasFile('logo'))
        {
            $old_logo_path = public_path() .  '/storage/order_logo/' . $order->logo;  
            if (file_exists($old_logo_path)) {
                @unlink($old_logo_path);
            }
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/order_logo', $fileNameToStore);
        }
       

        if($request->hasFile('user_music'))
        {
            $old_user_music_path = public_path() .  '/storage/users_music/' . $order->user_music; 
            if (file_exists($old_user_music_path)) {
                @unlink($old_user_music_path);
            }
            $filenameWithExt = $request->file('user_music')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('user_music')->getClientOriginalExtension();
            $userMusic= $filename.'_'.time().'.'.$extension;
            $path = $request->file('user_music')->storeAs('public/users_music', $userMusic);
        }

        $productPrice= Product::findOrFail($request->product_id)->price;
        if($request->coupon_code)
        {
            $coupon = Coupon::where('code','=',$request->coupon_code)->first();
            $discount = ($productPrice * $request->product_quantity) * ($coupon->amount / 100);
            $total_price = ($productPrice * $request->product_quantity)-($discount);
        }
        else{
            $total_price = ($productPrice * $request->product_quantity);
        }
        $data = $request->only('product_id','platform_id','music_id','template_id',
            'notes','video_length','product_quantity','background','background_color','delivery_id','user_music');
        $OrderInfo = array_merge($data , ['total_price'=> $total_price ,
            'logo'=>$fileNameToStore ,'download_file'=>$orderDownload ,'user_id'=>auth()->guard('api')->user()->id,'user_music'=>$userMusic]);

        $orderObject = $order->update($OrderInfo);

        if($request->city || $request->country || $request->address || $request->lat || $request->long)
        {
            $Data = $request->only('country','city','address','lat','lng');
            $locationData = array_merge($Data,['order_id' =>  $order->id,'user_id' => auth()->guard('api')->user()->id]);
            $location->update($locationData);
        }

        return  $orderObject;
      
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
            'download_file' => $order->download_file,
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
                "&currency=SAR".
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

    public static function getStatus($checkoutId)
    {
            $url = "https://test.oppwa.com/v1/checkouts/{$checkoutId}/payment";
            $url .= "?entityId=8a8294174d0595bb014d05d82e5b01d2";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            return $responseData;
    }

    public static function updateAdminOrder($order, $request){

        if(!empty($request['download_file'])){
            $image_path = public_path() .  '/storage/orders-download/' . $order->download_file;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $filenameWithExt = $request['download_file']->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request['download_file']->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request['download_file']->storeAs('public/orders-download', $fileNameToStore);
      
    
            $order->update(['status_id'=> $request['status_id'] , 'download_file'=>$fileNameToStore ]);
        }
        $order->update(['status_id'=> $request['status_id'] ]);

    }

}