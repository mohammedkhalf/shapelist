<?php

namespace App\Models\Product;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\ProductAttribute;
use App\Models\Product\Traits\ProductRelationship;
use App\Models\SharedModel;
use App\Models\Order\Order;

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
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $fileNameToStore = "/".$fileNameToStore;
        $url=  asset('storage/app/public/product_images').$fileNameToStore;

        $data = $request->only('name','name_ar','description','description_ar','price','points');
        $productData = array_merge($data , ['image' => $url]);
        $pakageProduct = Product::create($productData);
        return $pakageProduct;
    }

    public static function updateProduct($request ,  $product)
    {
        if (request()->hasFile('image')){
            $old_image_path = public_path() .  '/storage/product_images/' . $product->image;  // prev image path
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
             // Get filename with the extension
             $filenameWithExt = $request->file('image')->getClientOriginalName();
             // Get just filename
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             // Get just ext
             $extension = $request->file('image')->getClientOriginalExtension();
             // Filename to store
             $fileNameToStore= $filename.'_'.time().'.'.$extension;
             // Upload Image
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
            $updateData = $request->only('name','name_ar','description','description_ar','price','points');

            $fileNameToStore = "/".$fileNameToStore;
            $url=  asset('storage/app/public/product_images').$fileNameToStore;

            $updateProduct = array_merge($updateData , ['image' => $url]);
            $product->update($updateProduct);
        }//if
        else{
           $updateData=$request->only('name','name_ar','description','description_ar','price','points');
           $product->update($updateData);
        }

    
    }
}
