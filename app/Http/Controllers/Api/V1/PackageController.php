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
        $package = Package::all();
        foreach($package as $package){
                
                $productNames = explode(",",Package::all()->pluck('product_id')[0]);
                $quantityArr = explode(",",Package::all()->pluck('quantity')[0]);
                $i=0;

                    foreach($productNames as $product){
                        $name= Product::where('id',$productNames[$i])->first();
                        $data[] 
                        = array(
                            'product_id' => $productNames[$i],
                            'name'=>$name->name,
                            'quantitiy' => $quantityArr[$i],
                        );
                    
                        $i= $i+1;
                    }
                return response()->json(['product'=> $data ,'package_id' => $package->id,'name_ar' => $package->name_ar,
                'name_en' => $package->name_en,'description_ar' => $package->desc_ar  ,'description_en' =>$package->desc_en ,'price' => $package->price ]); 
        }           

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
