<?php

namespace App\Models\Delivery;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Delivery\Traits\DeliveryAttribute;
use App\Models\Delivery\Traits\DeliveryRelationship;
use App\Models\SharedModel;

class Delivery extends Model
{
    use ModelTrait,
        DeliveryAttribute,
        SharedModel,
    	DeliveryRelationship {
            // DeliveryAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'deliveries';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

    ];

    protected $casts = [
        'price' => 'float',
        'capacity' => 'integer'
    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    protected $hidden = [
        'created_at',
        'updated_at'
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
}
