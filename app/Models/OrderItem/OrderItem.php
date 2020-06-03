<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
