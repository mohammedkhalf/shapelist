<?php

namespace App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;
use App\Models\MusicSample\MusicSample;

class OrderItem extends Model
{
    protected $table = 'order_items';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','user_id','product_id','music_id',
        'price_per_item','items_total_price','video_length','user_music','quantity','type'];

    
        public static function insertProductItems($request)
        {
            if($request->user_music)
            {
                $fileNameToStore= pathinfo($request->user_music->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$request->user_music->getClientOriginalExtension();
                $request->user_music->storeAs('public/users_music', $fileNameToStore);
            } else {
                $fileNameToStore = '';
            }
            $product = OrderItem::create(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length'), 
            ['user_music'=>$fileNameToStore,'product_id'=>$request->item_id,'type'=>$request->type,'user_id'=>auth()->guard('api')->user()->id]));
            return $product;
        } 

        public static function updateProductItems($request,$id)
        {
            $productObj = OrderItem::findOrFail($id);
            if($request->user_music)
            {
                $old_music_path = public_path() .  '/storage/users_music/' . $productObj->user_music;  // prev url path
                if (file_exists($old_music_path)) {
                    @unlink($old_music_path);
                }
                $fileNameToStore= pathinfo($request->user_music->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$request->user_music->getClientOriginalExtension();
                $request->user_music->storeAs('public/users_music', $fileNameToStore);
            } else {
                $fileNameToStore = '';
            }
            $product = OrderItem::where('id',$id)
                      ->update(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length','user_music'), 
                      ['user_music'=>$fileNameToStore,'product_id'=>$request->item_id , 'type'=>$request->type ,'user_id'=>auth()->guard('api')->user()->id]));
            return $product;
        } 

}
