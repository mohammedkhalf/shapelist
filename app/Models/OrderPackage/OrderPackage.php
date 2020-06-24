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
    protected $fillable = [
        'order_id','package_id','quantity','package_total_price','package_music_id','vedio_length','package_user_music'
    ];
}
