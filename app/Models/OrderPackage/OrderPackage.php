<?php

namespace App\Models\OrderPackage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;

class OrderPackage extends Model
{
    protected $table = 'order_packages';
    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','user_id','package_id','music_id',
    'price_per_item','items_total_price','video_length','user_music','quantity','type'];

    protected $casts = [
        'price_per_item' => 'integer',
        'items_total_price' => 'integer',
        'quantity' => 'integer',
        'package_id'=> 'integer'
    ];

     public function packages()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public static function insertPackages($request)
    {
            if(OrderPackage::where('package_id','=',$request->item_id)->count() > 0)
            {
                OrderPackage::where('package_id','=',$request->item_id)->update(['items_total_price'=>$request->items_total_price,'quantity'=>$request->quantity]);
            }
            else{
                OrderPackage::create(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length','user_music') , 
                ['package_id'=>$request->item_id , 'type'=>$request->type ,'user_id'=>auth()->guard('api')->user()->id]));
            }
            $packageData = OrderPackage::with('packages')->where('package_id',$request->item_id)->get();
            foreach($packageData as $packageObj)
            {
                $packgeArr = ['id'=>$packageObj->id,'package_id'=>$packageObj->package_id,'quantity'=>$packageObj->quantity,'price_per_item'=>$packageObj->price_per_item,'items_total_price'=>$packageObj->items_total_price,'name_en'=>$packageObj->packages->name_en,'name_ar'=>$packageObj->packages->name_ar];
            }
            return $packgeArr;
    } 

    public static function updatePackageItems($request,$id)
    {
        $packageObj = OrderPackage::findOrFail($id);
        if($request->user_music)
        {
                $old_music_path = public_path() .  '/storage/users_music/' . $packageObj->user_music;  // prev url path
                if (file_exists($old_music_path)) {
                    @unlink($old_music_path);
                }
                $fileNameToStore= pathinfo($request->user_music->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$request->user_music->getClientOriginalExtension();
                $request->user_music->storeAs('public/users_music', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = '';
        }

        $package = OrderPackage::where('id',$id)
                      ->update(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length','user_music'), 
                      ['user_music'=>$fileNameToStore,'package_id'=>$request->item_id , 'type'=>$request->type ,'user_id'=>auth()->guard('api')->user()->id]));
                      
        return  $package;
    }  
}
