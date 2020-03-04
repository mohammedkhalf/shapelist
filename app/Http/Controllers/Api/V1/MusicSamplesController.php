<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\MusicSample\MusicSample;
use Illuminate\Http\Request;

class MusicSamplesController extends Controller
{
 
    //======================== index music_samples  ======================
    public function index()
    {
        $music_sample = MusicSample::all();
        return response()->json($music_sample);
    }

    //======================== create music_samples  ======================
    public function store(Request $request)
    {

    try{
        if($request->hasFile('url')){
            // Get filename with the extension
            $filenameWithExt = $request->file('url')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('url')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload record
            $path = $request->file('url')->storeAs('public/music_samples', $fileNameToStore);
        } else {
            $fileNameToStore = 'noRecord.mp3';
        }


        $music_sample = new MusicSample;
        $music_sample->name= $request->name;
        $music_sample->type= $request->type;
        $music_sample->url= $fileNameToStore;
        $music_sample->save();
        return response()->json($music_sample);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this music_samples is already registered!" );
        }}
    }

    //======================== show music_sample  ======================
    
    public function show($id)
    {
        $music_sample = MusicSample::findOrFail($id);
        return response()->json($music_sample);
    }


    //======================== update music_sample  ======================

    public function update(Request $request, $id)
    {
        if($request->hasFile('url')){
            // Get filename with the extension
            $filenameWithExt = $request->file('url')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('url')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload record
            $path = $request->file('url')->storeAs('public/music_samples', $fileNameToStore);
        } else {
            $music_sample = MusicSample::findOrFail($id);
            $fileNameToStore = $music_sample->url;
        }    
              
                    $music_sample = MusicSample::findOrFail($id);
                    $music_sample->name= $request->name;
                    $music_sample->type= $request->type;
                    $music_sample->url= $fileNameToStore;
                    $music_sample->save();

                    return response()->json($music_sample);
                 }

    // //======================== delete music_sample  ======================

    public function destroy($id)
    {
        $music_sample = MusicSample::findOrFail($id);
        $music_sample -> delete();  
        return response()->json("deleted successfully");
 
     }
    }
