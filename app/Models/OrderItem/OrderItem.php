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
    protected $fillable = ['order_id','product_id','platform_id','music_id','product_quantity',
        'price_per_product','products_total_price','video_length','user_music'];

    //relationship
    // public function musicSamples()
    // {
    //     return $this->belongsTo(MusicSample::class,'music_id');
    // }

}
