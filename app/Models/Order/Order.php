<?php

namespace App\Models\Order;
use App\Models\Product\Product;
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
use App\Models\OrderItem\OrderItem;
use Illuminate\Support\Str;

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
    protected $fillable = ['user_id','status_id','coupon_code',
    'total_price','notes','delivery_id','on_set' , 'music_id','video_length','user_music'];
    
    //relationships
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');   
    }
    
    public function location()
    {
        return $this->hasOne(Location::class,'order_id');   
    } 
    public function status()
    {
        return $this->belongsTo(Status::class,'status_id','id');   
    }  
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items');   
    }
    //static functions
    //Insert location
    public static function findOrCreateLocation($request,$orderObj)
    {
        if($request->location_id)
        {
            $locationInfo = Location::findOrFail($request->location_id);
            $locationArr = ['country'=>$locationInfo->country,'city'=>$locationInfo->city,'address'=>$locationInfo->city,'lng'=>$locationInfo->lng,
            'lat'=>$locationInfo->lat,'rep_first_name'=>$locationInfo->rep_first_name,'rep_last_name'=>$locationInfo->rep_last_name,'rep_phone_number'=>$locationInfo->rep_phone_number];
            Location::create(array_merge($locationArr,['order_id'=>$orderObj->id, 
            'user_id'=>auth()->guard('api')->user()->id]));
        }
        Location::create(array_merge($request->only('country','city','address','lng','lat','rep_first_name','rep_last_name','rep_phone_number'),
        ['order_id'=>$orderObj->id,'user_id'=>auth()->guard('api')->user()->id]));
    }

    //Update location
    public static function updateLocation($request,$orderObj)
    {
        if($request->location_id)
        {
            $locationInfo = Location::findOrFail($request->location_id);
            $locationObj = Location::where('order_id',$orderObj->id)
                           ->update(['country'=>$locationInfo->country,'city'=>$locationInfo->city,'address'=>$locationInfo->city,'lng'=>$locationInfo->lng,
                          'lat'=>$locationInfo->lat,'rep_first_name'=>$locationInfo->rep_first_name,'rep_last_name'=>$locationInfo->rep_last_name,'rep_phone_number'=>$locationInfo->rep_phone_number]);          
        }
        $locationObj=Location::where('order_id',$orderObj->id)
                    ->update(array_merge($request->only('country','city','address','lng','lat','rep_first_name','rep_last_name','rep_phone_number'),
                    ['order_id'=>$orderObj->id,'user_id'=>auth()->guard('api')->user()->id]));
    }

    //Insert orderItems
    public static function insertOrderItems($request,$orderObj)
    {
        if($request->products)
        {
            for ($i = 0; $i<count($request->products);$i++)
            {
                $data = [ 'product_id'=>$request->products[$i]['product_id'],
                          'product_quantity' =>$request->products[$i]['product_quantity'],
                          'product_total_price' => $request->products[$i]['product_total_price']
                        ];
                $items = array_merge($data,['order_id'=>$orderObj->id]);
                OrderItem::create($items);
            } //for      
        }   
    }

    //update order Item 
    public static function updateOrderItems($request,$orderObj)
    {
        for($i = 0; $i<count($request->products);$i++)
        {
             OrderItem::where(['order_id'=>$orderObj->id ,'product_id'=>$request->products[$i]['product_id']])
                        ->update(['product_quantity'=>$request->products[$i]['product_quantity'] ,
                                  'product_total_price'=>$request->products[$i]['product_total_price']
                                ]);
        } //for
    }

    //upload Music
    public static function uploadMusic ($request)
    {
        global $fileNameToStore;
        if($request->hasFile('user_music'))
        {
            $filenameWithExt = $request->file('user_music')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('user_music')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('user_music')->storeAs('public/users_music', $fileNameToStore);
        }
        return $fileNameToStore;
    }

    // update upload Music
    public static function updateUploadMusic ($request, $orderObj)
    {
        if($request->hasFile('user_music'))
        {
            $old_user_music_path = public_path().'/storage/users_music/'.$orderObj->user_music; 
            if (file_exists($old_user_music_path)) {
                @unlink($old_user_music_path);
            }
            $filenameWithExt = $request->file('user_music')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('user_music')->getClientOriginalExtension();
            $userMusic= $filename.'_'.time().'.'.$extension;
            $path = $request->file('user_music')->storeAs('public/users_music', $userMusic);
        }
    }

    //insert Order
    public static function insertOrder($request)
    {      
        $fileName = Order::uploadMusic($request);
        $OrderData = array_merge($request->only('delivery_id','music_id','total_price','video_length','coupon_code','on_set'),['user_music'=>$fileName ,'user_id'=>auth()->guard('api')->user()->id]);
        $orderObj = Order::create($OrderData);
        Order::findOrCreateLocation($request,$orderObj);
        Order::insertOrderItems($request,$orderObj);
        return response()->json(['message'=>'Order Created Successfully']);
    }

    //Update Order
    public static function updateOrder($request,$id)
    {
        $orderObj = Order::findOrFail($id);
        $fileName = Order::updateUploadMusic($request, $orderObj);
        $OrderData = array_merge($request->only('delivery_id','music_id','total_price','video_length','coupon_code','on_set'),['user_music'=>$fileName ,'user_id'=>auth()->guard('api')->user()->id]);
        $orderObj->update($OrderData);
        Order::updateLocation($request,$orderObj);
        Order::updateOrderItems($request,$orderObj);
    }

    public static function updateAdminOrder($order, $request)
    {

    }

    //payment methods
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
}