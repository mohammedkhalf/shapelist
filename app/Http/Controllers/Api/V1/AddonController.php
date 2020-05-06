<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Addon\Addon;
use Illuminate\Http\Request;

class AddonController extends APIController
{
    public function index()
    {
        $addon = Addon::all();
        return response()->json($addon);
    }
    
}
