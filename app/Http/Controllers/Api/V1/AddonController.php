<?php

namespace App\Http\Controllers;
use App\addons;
use Illuminate\Http\Request;

class AddonController extends Controller
{

    //======================== index addon  ======================
    public function index()
    {
        $addon = addons::all();
        return response()->json($addon);
    }

    //======================== create addon  ======================
    public function store(Request $request)
    {

    try{

        $addon = new addons;
        $addon->name= $request->name;
        $addon->type= $request->type;
        $addon->price= $request->price;
        $addon->save();
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
        $addon = addons::findOrFail($id);
        return response()->json($addon);
    }


    //======================== update addon  ======================

    public function update(Request $request, $id)
    {

                    $addon = addons::findOrFail($id);
                    $addon->name= $request->name;
                    $addon->type= $request->type;
                    $addon->price= $request->price;
                    $addon->save();

                    return response()->json($addon);
                 }

    //======================== delete addon  ======================

    public function destroy($id)
    {
        $addon = addons::findOrFail($id);
        $addon -> delete();
        return response()->json("deleted successfully");

     }
}
