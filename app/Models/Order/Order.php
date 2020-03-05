<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';


    public function posision()
    {
        return $this->hasOne('App\Models\Position\Position','position_id','id');
    }
}
