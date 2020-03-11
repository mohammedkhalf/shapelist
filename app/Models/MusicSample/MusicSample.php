<?php

namespace App\Models\MusicSample;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\MusicSample\Traits\MusicSampleAttribute;
use App\Models\MusicSample\Traits\MusicSampleRelationship;

class MusicSample extends Model
{
    use ModelTrait,
        MusicSampleAttribute,
    	MusicSampleRelationship {
            // MusicSampleAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'music_samples';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'name','url'
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

    public static function insertMusic($request)
    {
        if(!empty($request['url']))
        {
            // Get filename with the extension
            $filenameWithExt = $request['url']->getClientOriginalName();
            // dd($filenameWithExt);
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request['url']->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload url
            $path = $request['url']->storeAs('public/smaples', $fileNameToStore);
        } else {
            $fileNameToStore = 'sample.jpg';
        }
        $music = MusicSample::create(['name'=> $request['name'] , 'url'=>$fileNameToStore]);
        return $music;
    }

    public static function updateMusic ($musicsample , $request)
    {
         // dd($request);
         if(!empty($request['url']))
         {
             $old_music_path = public_path() .  '/storage/smaples/' . $musicsample->url;  // prev url path
             if (file_exists($old_music_path )) {
                 @unlink($old_music_path );
             }
             // Get filename with the extension
             $filenameWithExt = $request['url']->getClientOriginalName();
             // Get just filename
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             // Get just ext
             $extension = $request['url']->getClientOriginalExtension();
             // Filename to store
             $fileNameToStore= $filename.'_'.time().'.'.$extension;
             // Upload url
             $path = $request['url']->storeAs('public/smaples', $fileNameToStore);
 
         } 
 
         $musicsample->update(['name'=> $request['name'] , 'url'=>$fileNameToStore]);

         return $musicsample;

    }
}
