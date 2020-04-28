<?php

namespace App\Models\Location;
use App\Models\Access\User\User;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location\Traits\LocationAttribute;
use App\Models\Location\Traits\LocationRelationship;
use App\Models\Order\Order;
use App\Models\SharedModel;
class Location extends Model
{
    use ModelTrait,
        LocationAttribute,
        SharedModel,
    	LocationRelationship {
            // LocationAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'locations';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'country', 'city','address', 'postal_code','unit_no','state'
        ,'lng','lat','user_id','order_id','rep_first_name','rep_last_name','rep_phone_number'
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

        //Use Relation
    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');   
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');   
    } 
}
