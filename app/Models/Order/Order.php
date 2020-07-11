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

    public static function CreteOrderRequest($request)
    {
        $orderData = Order::create(array_merge($request->only('delivery_id','location_id','sub_total','vat','total_price','on_set','coupon_code'),
        ['user_id'=>auth()->guard('api')->user()->id]));
        if($request->location_id)
        { 
            $locationInfo = Location::findOrFail($request->location_id);
            $data = array_merge(['country'=> $locationInfo->country,'city'=> $locationInfo->city,'address'=> $locationInfo->address,
            'lat'=> $locationInfo->lat,'lng'=> $locationInfo->lng,'rep_first_name'=>$request->rep_first_name,'rep_last_name'=>$request->rep_last_name,
            'rep_phone_number'=>$request->rep_phone_number],['order_id'=>$orderData->id,'user_id'=>auth()->guard('api')->user()->id]);
            Location::create($data);
        }
        else
        {
            Location::create(array_merge($request->only('country','city','address','lng','lat','rep_first_name','rep_last_name','rep_phone_number'),
            ['order_id'=>$orderData->id,'user_id'=>auth()->guard('api')->user()->id]));
        }

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