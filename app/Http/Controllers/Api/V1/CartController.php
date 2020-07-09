<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use App\Http\Requests\Backend\Cart\StoreCartRequest;
use App\Http\Requests\Backend\Cart\UpdateCartRequest;


class CartController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreCartRequest $request)
    {
        if($request->type == "product")
        {
            $ItemData=OrderItem::insertProductItems($request);
        }
        else 
        {
            $ItemData=OrderPackage::insertPackages($request);
        }
        return response()->json(['ItemData'=>json_decode($ItemData),'message'=>'Item added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function update(UpdateCartRequest $request, $id)
    {
        if($request->type == "product")
        {
            $updated_Item = OrderItem::updateProductItems($request,$id);
        }
        else{
            $updated_Item = OrderPackage::updatePackageItems($request,$id);
        }
        return response()->json(['ItemData'=>json_decode($updated_Item),'message'=>'Item update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->type == "product")
        {
            OrderItem::findOrFail($id)->delete();
        }
        else 
        {
            OrderPackage::findOrFail($id)->delete();
        }
        return response()->json(['message'=>'Item Deleted Successfully']);
    }

}
