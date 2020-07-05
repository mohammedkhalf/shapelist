<?php

namespace App\Models\MediaFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Order\Order;

class MediaFile extends Model
{
    protected $table = 'media_files';
    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','zip_name','path','size','auth_by'];

    //Relationship Function
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    //model functions
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($image) {
            $image->auth_by = auth()->user()->id;
        });
    }

}
