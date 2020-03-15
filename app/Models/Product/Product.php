<?php

namespace App\Models\Product;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\ProductAttribute;
use App\Models\Product\Traits\ProductRelationship;
use App\Models\SharedModel;

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
        $data = $request->only('name','description','price');
        $productData = array_merge($data , ['image' => $fileNameToStore]);
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
            $updateData = $request->only('name','description','price');
            $updateProduct = array_merge($updateData , ['image' => $fileNameToStore]);
            $product->update($updateProduct);
        }//if
        else{
           $updateData=$request->only('name','description','price');
           $product->update($updateData);
        }

    
    }
}
