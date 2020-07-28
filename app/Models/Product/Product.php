<?php

namespace App\Models\Product;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\ProductAttribute;
use App\Models\Product\Traits\ProductRelationship;
use App\Models\SharedModel;
use App\Models\Order\Order;
use Illuminate\Support\Str;

class Product extends Model
{
    use ModelTrait,
        ProductAttribute,
        SharedModel,
    	ProductRelationship {
            // ProductAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'products';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

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

    //relations
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_items');   
    } 

    public static function insertProduct($request)
    {
        $data = $request->only('name','name_ar','price','points');
        $desc=Str::replaceArray('/^\<p\>/',[],$request->description);
        $desc_ar = Str::replaceArray('/^\<p\>/',[],$request->description_ar);
        $productData = array_merge($data , ['description'=>$desc,'description_ar'=> $desc_ar]);
        $pakageProduct = Product::create($productData);
        return $pakageProduct;
    }

    public static function updateProduct($request ,  $product)
    {
        $data = $request->only('name','name_ar','price','points');
        $desc= Str::replaceArray('/^\<p\>/',[],$request->description);
        $desc_ar = Str::replaceArray('/^\<p\>/',[],$request->description_ar);
        $productData = array_merge($data , ['description'=>$desc,'description_ar'=>$desc_ar]);
        $product->update($productData);
    }
}
