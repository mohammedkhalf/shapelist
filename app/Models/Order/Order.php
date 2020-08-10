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
use Illuminate\Contracts\Filesystem\Filesystem;
use  App\Models\Invoice\Invoice;
use App\Models\Delivery\Delivery;

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

    public function delivery()
    {
        return $this->belongsTo(Delivery::class,'delivery_id','id');
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
        return $this->belongsToMany(Product::class,'order_items')->withPivot('order_id','product_id','type','quantity','music_id','video_length','user_music');  
    }
    public function payment()
    {
        return $this->hasOne(Payment::class,'order_id');   
    }
    //package_order
    public function package()
    {
        return $this->belongsToMany(Package::class,'order_packages')->withPivot('order_id','music_id','package_id','quantity','type','video_length','user_music'); 
    }
    //media attach
    public function media()
    {
        return $this->hasMany(MediaFile::class ,'order_id','id');
    }
    //order Invoice
    public function invoices()
    {
        return $this->hasOne(Invoice::class ,'order_id','id');
    }

    public static function CreateOrderRequest($request)
    {
        $orderData = Order::create(array_merge($request->only('delivery_id','vat','total_price','coupon_code'),
        ['user_id'=>auth()->guard('api')->user()->id]));
        $locationArr = array($request->location_details);
        foreach($locationArr as $key=>$value)
        {
            $data = ['country'=>$value['country'],'city'=>$value['city'],'address'=>$value['address'],'postal_code'=>$value['postal_code'],'lat'=>$value['lat'],'lng'=>$value['lng'],'rep_first_name'=>$value['rep_first_name'],'rep_phone_number'=>$value['rep_phone_number']];
        }
        Location::create(array_merge($data,['order_id'=>$orderData->id,'user_id'=>auth()->guard('api')->user()->id]));
        return $orderData;
    }

    public static function updateAdminOrder($order, $request)
    {
        $request->validate([
            'status_id' =>['numeric','not_in:0','exists:'. Status::table() .',id'],
            'media_file' => '|file|mimes:zip,rar'
        ]);
        $OrderObj=$order->update($request->only('status_id'));
        if($request->hasfile('media_file'))
        {
           $file = $request->file('media_file');
           $name = time().$file->getClientOriginalName();
           $filePath = 'media_files/' . $name;
           Storage::disk('s3')->put($filePath, file_get_contents($file));
           MediaFile::create(['auth_by'=> auth()->user()->id,'order_id'=>$order->id,
           'path'=>$filePath,'zip_name'=>$name ,'size' =>  number_format(Storage::disk('s3')->size($filePath)/ 1048576, 2)]);
           return back()->with('success','media_file Uploaded successfully');
        }
    }

    //
    public static function sendPdfInvoice($OrderObject) 
    {
        $data = [
            'Invoice_Number' => $OrderObject->id,
            'user_id' => auth()->guard('api')->user()->id,
            'first_name' => auth()->guard('api')->user()->first_name,
            'last_name' => auth()->guard('api')->user()->last_name,
            'email'=> auth()->guard('api')->user()->email,
            'phone_number'=> auth()->guard('api')->user()->phone_number,
            // 'sub_total'=> $OrderObject->sub_total,
            'vatPercentage' => Quotation::where('name','Vat')->pluck('rate')->first(),
            'vat_value'=>$OrderObject->vat,
            'total_price' => $OrderObject->total_price,
            'date' => $OrderObject->created_at,
            'subject'=> 'Purchase Invoice',
            'locationInfo' => Order::with('location')->where(['id'=>$OrderObject->id,'user_id'=>auth()->guard('api')->user()->id])->get(),
            'productsInfo' => OrderItem::where('order_id',$OrderObject->id)->get(),
        ];
            //author@khalf
            $customPaper = array(0,0,950,1200);
            $pdf = PDF::loadView('emails.email-invoice', $data)->setPaper($customPaper,'portrait');
            $fileName = time() . ".pdf";
            Storage::put('public/orders-pdf/'.$data['user_id'] . '/' . $data['Invoice_Number'] . '/' . $fileName, $pdf->output());
            Invoice::create(['order_id'=>$OrderObject->id,'file_name'=>$fileName]);
            Mail::send('emails.email-body',$data,function($message)use($data,$pdf) {
                $message->to($data["email"],$data["first_name"],$data["Invoice_Number"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(),"invoice.pdf");
                });   
            return $pdf->download('invoice.pdf');
    }

    //get Payment Status Object Using Checkout Id
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

    //
}