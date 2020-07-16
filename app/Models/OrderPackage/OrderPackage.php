<?php

namespace App\Models\OrderPackage;

use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    protected $table = 'order_packages';
    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','user_id','package_id','music_id',
    'price_per_item','items_total_price','video_length','user_music','quantity','type'];

    public static function insertPackages($request)
    {
            if(OrderPackage::where('package_id','=',$request->item_id)->count() > 0)
            {
                OrderPackage::where('package_id','=',$request->item_id)->update(['quantity'=>$request->quantity]);
                return OrderPackage::where('package_id','=',$request->item_id)->get();
            }
            // if($request->user_music)
            // {
            //     $fileNameToStore= pathinfo($request->user_music->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$request->user_music->getClientOriginalExtension();
            //     $path = $request->user_music->storeAs('public/users_music', $fileNameToStore);
            // } else {
            //     $fileNameToStore = '';
            // }
            return  OrderPackage::create(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length','user_music') , 
            ['package_id'=>$request->item_id , 'type'=>$request->type ,'user_id'=>auth()->guard('api')->user()->id]));
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
