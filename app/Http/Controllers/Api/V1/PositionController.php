<?php

namespace App\Http\Controllers;
use App\positions;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    //======================== index positions  ======================
    public function index()
    {
        $position = positions::all();
        return response()->json($position);
    }

    //======================== create positions  ======================
    public function store(Request $request)
    {

    try{
        $position = new positions;
        $position->name= $request->name;
        $position->save();
        return response()->json($position);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this position is already registered!" );
        }}
    }

    //======================== show positions  ======================
    
    public function show($id)
    {
        $position = positions::findOrFail($id);
        return response()->json($position);
    }


    //======================== update position  ======================

    public function update(Request $request, $id)
    {
       
                    $position = positions::findOrFail($id);
                    $position->name= $request->name;
                    $position->save();
                    return response()->json($position);
                 }

    //======================== delete positions  ======================

    public function destroy($id)
    {
        $position = positions::findOrFail($id);
        $position -> delete();  
        return response()->json("deleted successfully");
 
     }
}
