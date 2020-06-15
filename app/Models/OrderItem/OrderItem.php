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
        'product_total_price','logo','video_length','content','background','background_color',
        'user_music','notes'];

    //relationship
    // public function musicSamples()
    // {
    //     return $this->belongsTo(MusicSample::class,'music_id');
    // }

}
