<?php
<<<<<<< HEAD
=======

>>>>>>> upstream/master
namespace App\Models\Platform;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Platform\Traits\PlatformAttribute;
use App\Models\Platform\Traits\PlatformRelationship;

class Platform extends Model
{
    use ModelTrait,
        PlatformAttribute,
    	PlatformRelationship {
            // PlatformAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'platforms';

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

    public static function insertPlatform ($request)
    {
        if(!empty($request['image']))
        {
            // Get filename with the extension
            $filenameWithExt = $request['image']->getClientOriginalName();
            // dd($filenameWithExt);
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request['image']->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request['image']->storeAs('public/platform', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $platform = Platform::create(['name'=> $request['name'] , 'image'=>$fileNameToStore]);
        return $platform;
    }

    public static function updatePlatform($platform,$request)
    {
        // dd($request);
        if(!empty($request['image']))
        {
            $old_image_path = public_path() .  '/storage/platform/' . $platform->image;  // prev image path
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
            // Get filename with the extension
            $filenameWithExt = $request['image']->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request['image']->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request['image']->storeAs('public/platform', $fileNameToStore);

            $platform->update(['name'=> $request['name'] , 'image'=>$fileNameToStore]);
        } 

        $platform->update(['name'=> $request['name']]);

        return $platform;
    }

    
}
