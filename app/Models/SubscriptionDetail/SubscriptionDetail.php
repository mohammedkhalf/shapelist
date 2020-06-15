<?php

namespace App\Models\SubscriptionDetail;

use Illuminate\Database\Eloquent\Model;

class SubscriptionDetail extends Model
{
    //
    protected $table = 'subscription_details';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['subscription_status','purchase_points','free_points','subscription_start_date',
    'subscription_end_date','subscription_bank_id'

    ];
  
   


}
