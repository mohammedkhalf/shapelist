<?php

namespace App\Models\PacakgeDetail;

use Illuminate\Database\Eloquent\Model;

class PacakgeDetail extends Model
{
    protected $table = 'pacakge_details';
    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'package_id','product_id','quantity'
    ];
}
