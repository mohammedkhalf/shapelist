<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Template\Template;
use Illuminate\Http\Request;

class TemplateController extends APIController
{

    //======================== index Position  ======================
    public function index()
    {
        $position = Template::all();
        return response()->json($position);
    }

    //======================== create Position  ======================
    public function store(Request $request)
    {
    try{
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/template_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $data = $request->only('name');
        $positionData = array_merge($data , ['image' => $fileNameToStore]);
        $pakagePosition = Template::create($positionData);
        return response()->json($pakagePosition);



    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this Template is already registered!" );
        }}
    }

    //======================== show Position  ======================
    
    public function show($id)
    {
        $position = Template::findOrFail($id);
        return response()->json($position);
    }


    //======================== update position  ======================

    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/template_images', $fileNameToStore);
        } else {
            $position = Template::findOrFail($id);
            $fileNameToStore = $position->image;
        }    
                    $position = Template::findOrFail($id);
                    $position->name= $request->name;
                    $position->image= $request->image;
                    $position->save();
                    return response()->json($position);
                 }

    //======================== delete Position  ======================

    public function destroy($id)
    {
        $position = Template::findOrFail($id);
        $position -> delete();  
        return response()->json("deleted successfully");
 
     }
}
