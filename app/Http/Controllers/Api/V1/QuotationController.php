<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Quotation\Quotation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vat()
    {
        $vat = Quotation::where('name', 'VAT')->get();
        return response()->json($vat);
    }

     public function onSet()
    {
        $onSet = Quotation::where('name', 'On-Set')->get();
        return response()->json($onSet);    
    }
}
