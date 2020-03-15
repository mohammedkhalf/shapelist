<?php

namespace App\Models\Template;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Template\Traits\TemplateAttribute;
use App\Models\Template\Traits\TemplateRelationship;
use App\Models\SharedModel;

class Template extends Model
{
    use ModelTrait,
        TemplateAttribute,
        SharedModel,
    	TemplateRelationship {
            // TemplateAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'templates';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'name' ,'image'
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


    public static function insertTemplate($request)
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
            $path = $request['image']->storeAs('public/templates', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $template = Template::create(['name'=> $request['name'] , 'image'=>$fileNameToStore]);
        return  $template;

    }

    public static function updateTemplate($template,$request)
    {
        if(!empty($request['image']))
        {
            $old_image_path = public_path() .  '/storage/templates/' . $template->image;  // prev image path
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
            $path = $request['image']->storeAs('public/templates', $fileNameToStore);

            $template->update(['name'=> $request['name'] , 'image'=>$fileNameToStore]);
        } 

        $template->update(['name'=> $request['name']]);

        return $template;
    }
}
