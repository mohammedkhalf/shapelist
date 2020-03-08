<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';


    protected $fillable = [
     'product_id','platform_id','addon_id',
        'location_id','coupon_id','music_id','status_id','products_quantity','video_length'
       ,'notes','product_price'
    ];
    
}
