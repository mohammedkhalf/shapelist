<?php

namespace App\Models\MediaFile;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'media_files';
    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','zip_name'];
}
