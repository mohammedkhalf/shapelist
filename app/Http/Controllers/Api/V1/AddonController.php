<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Addon\Addon;
use Illuminate\Http\Request;

class AddonController extends APIController
{

    //======================== index addon  ======================
    public function index()
    {
        $addon = Addon::all();
        return response()->json($addon);
    }

    //======================== create addon  ======================
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|unique:addons',
            'type'=> 'required',
            'price'=> 'required',
            ]);
    try{
         $addon = $request->only('name','type','price');
         Addon::create($addon);
        return response()->json($addon);
    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this addon is already registered!" );
        }}
    }

    //======================== show addon  ======================

    public function show($id)
    {
        $addon = Addon::findOrFail($id);
        return response()->json($addon);
    }

    //======================== update addon  ======================

    public function update(Request $request, $id)
    {
        $addon = Addon::findOrFail($id);
        $addonData = $request->only('name','type','price');
        $addon->update($addonData);
        return response()->json($addon);
                 }

    //======================== delete addon  ======================

    public function destroy($id)
    {
        $addon = Addon::findOrFail($id);
        $addon -> delete();
        return response()->json("deleted successfully");

     }
}
