<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    protected $table='templates';


    protected $fillable = [
        'name' ,'image'
    ];}
