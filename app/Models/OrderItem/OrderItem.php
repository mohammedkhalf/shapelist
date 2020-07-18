<?php

namespace App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product; 
use App\Models\MusicSample\MusicSample; 

class OrderItem extends Model
{
    protected $table = 'order_items';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','user_id','product_id','music_id','name_en','name_ar',
        'price_per_item','items_total_price','video_length','user_music','quantity','type'];

    protected $casts = [
        'price_per_item' => 'integer',
        'items_total_price' => 'integer',
        'quantity' => 'integer',
        'product_id'=> 'integer'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    
        public static function insertProductItems($request)
        {
            if(OrderItem::where('product_id','=',$request->item_id)->count() > 0)
            {
                OrderItem::where('product_id','=',$request->item_id)->update(['items_total_price'=>$request->items_total_price,'quantity'=>$request->quantity]);
            }                
            else{
                $productData = Product::findOrFail($request->item_id);
                OrderItem::create(array_merge($request->only('quantity','price_per_item','items_total_price','music_id','video_length'), 
                ['name_ar'=>$productData->name_ar,'name_en'=>$productData->name,'product_id'=>$request->item_id,'type'=>$request->type,'user_id'=>auth()->guard('api')->user()->id]));
            }
            $productData = orderItem::with('products')->where('product_id',$request->item_id)->get();
            foreach($productData as $proObj)
            {
                $productArr = ['id'=>$proObj->id,'product_id'=>$proObj->product_id,'quantity'=>$proObj->quantity,'price_per_item'=>$proObj->price_per_item,'items_total_price'=>$proObj->items_total_price,'name'=>$proObj->products->name,'name_ar'=>$proObj->products->name_ar];
            }
            return $productArr;
        } 

        


}
