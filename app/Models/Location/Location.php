<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table='locations';


        
    protected $fillable = [
        'country', 'city','address', 'postal_code','unit_no','state','lng','lat',
    ];


    public function user()
        {
            return $this->belongsTo('App\Models\Access\User');   
        }
}
