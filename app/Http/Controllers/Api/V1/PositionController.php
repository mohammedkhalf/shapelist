<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Position\Position;
use Illuminate\Http\Request;

class PositionController extends APIController
{

    //======================== index Position  ======================
    public function index()
    {
        $position = Position::all();
        return response()->json($position);
    }

    //======================== create Position  ======================
    public function store(Request $request)
    {

    try{
        $position = new Position;
        $position->name= $request->name;
        $position->save();
        return response()->json($position);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this position is already registered!" );
        }}
    }

    //======================== show Position  ======================
    
    public function show($id)
    {
        $position = Position::findOrFail($id);
        return response()->json($position);
    }


    //======================== update position  ======================

    public function update(Request $request, $id)
    {
       
                    $position = Position::findOrFail($id);
                    $position->name= $request->name;
                    $position->save();
                    return response()->json($position);
                 }

    //======================== delete Position  ======================

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position -> delete();  
        return response()->json("deleted successfully");
 
     }
}
