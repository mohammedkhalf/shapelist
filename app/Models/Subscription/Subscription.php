<?php

namespace App\Models\Subscription;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Traits\SubscriptionAttribute;
use App\Models\Subscription\Traits\SubscriptionRelationship;
use App\Models\Access\User\User;
use App\Models\Delivery\Delivery;


class Subscription extends Model
{
    use ModelTrait,
        SubscriptionAttribute,
    	SubscriptionRelationship {
            // SubscriptionAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

    ];

    protected $hidden = [
        'delivery_id'
    ];

    protected $casts = [
        'priority_support' => 'boolean',
        'price' => 'float',
        'purchase_points' => 'float',
        'free_points' => 'float',
        'discount' => 'float',
    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function subscription()
    {
        return $this->belongsToMany(User::class,'subscription_details')->withPivot('id','status','purchase_points','free_points','start_date','end_date');  
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class,'delivery_id','id');  
    }

}