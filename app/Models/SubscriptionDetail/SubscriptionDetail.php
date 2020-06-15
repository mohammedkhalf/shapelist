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
    protected $fillable = ['status','purchase_points','free_points','start_date',
    'end_date','bank_transaction_id'

    ];
  
   


}
