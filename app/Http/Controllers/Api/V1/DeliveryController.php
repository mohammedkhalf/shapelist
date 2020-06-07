<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Delivery\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //======================== index delivery  ======================
    public function index()
    {
        $delivery = Delivery::all();
        return response()->json($delivery);
    }
     //======================== show delivery  ======================
     public function show($id)
     {
         $delivery = Delivery::findOrFail($id);
         return response()->json($delivery);
     }
 
}
