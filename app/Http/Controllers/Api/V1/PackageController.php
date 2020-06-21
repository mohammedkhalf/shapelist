<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Package\Package;
use Illuminate\Http\Request;
use App\Models\Product\Product;


class PackageController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $productNames = explode(",",Package::all()->pluck('product_id')[0]);
        $quantityArr = explode(",",Package::all()->pluck('quantity')[0]);
        $data[] = ['products'=>$productNames ,'quantity'=>$quantityArr];
        dd(array_mereg($productNames,$quantityArr));
    
        // foreach($data as $key=>$value)
        // {
        //     // $productName = Product::where('id',$productNames[$i])->pluck('name')->first();
        //     $newArr[] = [
        //         'producName'=> $value['products'],
        //         'quantity' => $value['quantity']
        //     ];
        // }

        // dd($newArr);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
