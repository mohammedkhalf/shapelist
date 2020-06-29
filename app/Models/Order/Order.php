<?php

namespace App\Models\Order;
use App\Models\Product\Product;
use App\Models\Location\Location;
use App\Models\Payment\Payment;
use App\Models\Status\Status;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\OrderAttribute;
use App\Models\Order\Traits\OrderRelationship;
use Storage;
use App\Models\OrderItem\OrderItem;
use App\Models\Package\Package; 
use App\Models\OrderPackage\OrderPackage;
use App\Models\MediaFile\MediaFile;
use App\Models\Quotation\Quotation;
use Illuminate\Support\Facades\Mail;
use PDF;
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
    'sub_total','vat','total_price','delivery_id','on_set','location_id'];
    
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
        return $this->belongsToMany(Product::class,'order_items')->withPivot('type','product_quantity','music_id','video_length','user_music');  
    }
    public function payment()
    {
        return $this->hasOne(Payment::class,'order_id');   
    }
    //package_order
    public function package()
    {
        return $this->belongsToMany(Package::class,'order_packages')->withPivot('order_id','package_music_id','package_id','quantity','type','vedio_length','package_user_music'); 
    }
    //media attach
    public function media()
    {
        return $this->hasMany(MediaFile::class ,'order_id','id');
    }
    //static functions
    public static function insertOrder($request)
    {  
        // dd($request->all());
        $OrderData = array_merge($request->only('delivery_id','total_price','sub_total','vat','location_id','coupon_code','on_set'),['user_id'=>auth()->guard('api')->user()->id]);
        $orderObj = Order::create($OrderData);
        Order::findOrCreateLocation($request,$orderObj);
        $orderItems= Order::insertOrderItems($request,$orderObj);
        $packagesItems= Order::insertPackages($request,$orderObj);
        return response()->json(['message'=>'Order Created Successfully']);
    }

    //Insert orderItems
    public static function insertOrderItems($request , $orderObj)
    {
        global  $fileNameToStore;
        $productsArr = $request->products;
        for ($i=0; $i < count($productsArr); $i++)
        {
                if(!empty($productsArr[$i]['user_music']))
                {
                    $filenameWithExt=$productsArr[$i]['user_music']->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $productsArr[$i]['user_music']->getClientOriginalExtension();
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    $path = $productsArr[$i]['user_music']->storeAs('public/users_music',  $fileNameToStore);
                }
                
                    $data =
                    [ 
                        'product_quantity' =>$productsArr[$i]['product_quantity'],
                        'product_id'=>$productsArr[$i]['product_id'],
                        'price_per_product' => $productsArr[$i]['price_per_product'],
                        'products_total_price' => $productsArr[$i]['products_total_price'],
                        'video_length' => $productsArr[$i]['video_length'],
                        'music_id' => $productsArr[$i]['music_id'],
                        'user_music'=> $productsArr[$i]['product_id'] == 1 ?  $fileNameToStore : ""
                    ];
                
                $items = array_merge($data,['order_id'=>$orderObj->id]);
                $orderItemsInfo = OrderItem::create($items);
        } //for 

       
        return $orderItemsInfo;
    }
    //Insert location
    public static function findOrCreateLocation($request,$orderObj)
    {
        if($request->location_id)
        {
            $locationInfo = Location::findOrFail($request->location_id);
            $locationArr = ['country'=>$locationInfo->country,'city'=>$locationInfo->city,'address'=>$locationInfo->address,'lng'=>$locationInfo->lng,
            'lat'=>$locationInfo->lat,'rep_first_name'=>$locationInfo->rep_first_name,'rep_last_name'=>$locationInfo->rep_last_name,'rep_phone_number'=>$locationInfo->rep_phone_number];
            Location::create(array_merge($locationArr,['order_id'=>$orderObj->id, 
            'user_id'=>auth()->guard('api')->user()->id]));
        }
        else
        {
            Location::create(array_merge($request->only('country','city','address','lng','lat','rep_first_name','rep_last_name','rep_phone_number'),
            ['order_id'=>$orderObj->id,'user_id'=>auth()->guard('api')->user()->id]));
        }

    }

    //insert packages
    public static function insertPackages ($request,$orderObj)
    {
        if($request->packages)
        {
            for($i=0;$i<count($request->packages);$i++)
            {
                OrderPackage::create(['package_id'=>$request->packages[$i]['package_id'],
                'order_id'=>$orderObj->id,'quantity'=>$request->packages[$i]['quantity'],
                'price_per_package' => $request->packages[$i]['price_per_package'],
                'packages_total_price' => $request->packages[$i]['packages_total_price'],
                'package_music_id'=>$request->packages[$i]['package_music_id'],
                'vedio_length'=>$request->packages[$i]['vedio_length'],
                'package_user_music'=> !empty($request->packages[$i]['package_user_music']) ? $request->packages[$i]['package_user_music'] : ''
                ]);
            }
        }
    }

    //Update Order
    public static function updateOrder($request,$id)
    {
        $orderObj = Order::findOrFail($id);
        if($orderObj->status_id == NULL)
        {
            $orderObj->update(array_merge($request->only('delivery_id','total_price','location_id','coupon_code','on_set'),['user_id'=>auth()->guard('api')->user()->id]));
            Order::updateLocation($request,$orderObj);
            Order::updateOrderItems($request,$orderObj);
            return response()->json(['message'=>'Order Update Successfully']);     
        }
        return response()->json(['message'=>'Not Allow Update Order']);     
    }
    //update order Item 
    public static function updateOrderItems($request,$orderObj)
    {       
         global  $fileNameToStore;
         $productsArr  = ($request->products);
         for($i = 0; $i< count($productsArr); $i++)
         {
            if(!empty($productsArr[$i]['user_music']))
            {
                $old_user_music_path = public_path() .  '/storage/users_music/' . $orderObj->user_music; 
                if (file_exists($old_user_music_path)) {
                    @unlink($old_user_music_path);
                }
                $filenameWithExt=$productsArr[$i]['user_music']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $productsArr[$i]['user_music']->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $productsArr[$i]['user_music']->storeAs('public/users_music',  $fileNameToStore);
            }

            $updateOrderItems=OrderItem::where(['order_id'=>$orderObj->id ,'product_id'=>$productsArr[$i]['product_id']])
            ->update([
                  'product_quantity'=> $productsArr[$i]['product_quantity'],
                  'product_id'=> $productsArr[$i]['product_id'],
                  'video_length' => $productsArr[$i]['video_length'],
                  'music_id' => $productsArr[$i]['music_id'],
                  'user_music'=> $productsArr[$i]['product_id'] == 1 ?  $fileNameToStore : ""
                ]);
         } //for

         return $updateOrderItems;
     }

      //Update location
      public static function updateLocation($request,$orderObj)
      {
          if($request->location_id)
          {
              $locationInfo = Location::findOrFail($orderObj->id);
              $updatedLocation = Location::where('order_id',$orderObj->id)->update(['country'=>$locationInfo->country,'city'=>$locationInfo->city,'address'=>$locationInfo->city,'lng'=>$locationInfo->lng,
             'lat'=>$locationInfo->lat,'rep_first_name'=>$locationInfo->rep_first_name,'rep_last_name'=>$locationInfo->rep_last_name,'rep_phone_number'=>$locationInfo->rep_phone_number]);          
          }
          else
          {
            $updatedLocation = Location::where('order_id',$orderObj->id)->update(array_merge($request->only('country','city','address','lng','lat','rep_first_name','rep_last_name','rep_phone_number'),
              ['user_id'=>auth()->guard('api')->user()->id]));
          }
          return $updatedLocation;
      }   

    public static function updateAdminOrder($order, $request)
    {
        dd($request->all());
        $order->update($request->only('status_id'));
        return $order;
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

    public static function sendPdfInvoice($OrderObject) 
    {
        $data = [
            'Invoice_Number' => $OrderObject->id,
            'first_name' => auth()->guard('api')->user()->first_name,
            'last_name' => auth()->guard('api')->user()->last_name,
            'email'=> auth()->guard('api')->user()->email,
            'phone_number'=> auth()->guard('api')->user()->phone_number,
            'sub_total'=> $OrderObject->sub_total,
            'vatPercentage' => Quotation::where('name','Vat')->pluck('rate')->first(),
            'vat_value'=>$OrderObject->vat,
            'total_price' => $OrderObject->total_price,
            'date' => $OrderObject->created_at,
            'subject'=> 'Purchase Invoice',
            'locationInfo' => Order::with('location')->where(['id'=>$OrderObject->location_id,'user_id'=>auth()->guard('api')->user()->id])->get(),
            'productsInfo' => OrderItem::where('order_id',$OrderObject->id)->get(),
            'packagesInfo' => OrderPackage::where('order_id',$OrderObject->id)->get()
        ];
        $pdf = PDF::loadView('emails.email-invoice', $data);
        Mail::send('emails.email-body',$data,function($message)use($data,$pdf) {
            $message->to($data["email"], $data["first_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(),"invoice.pdf");
            });   
        return response()->json(['message'=>'Invoice Send Successfuly']);
    }
}