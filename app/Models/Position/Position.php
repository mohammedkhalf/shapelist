<?php

namespace App\Models\Position;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table='positions';


    public function order()
        {
            return $this->belongsTo('App\Models\Order\Order');   
        }
}
