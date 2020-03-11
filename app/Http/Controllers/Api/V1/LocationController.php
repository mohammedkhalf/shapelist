<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Location\Location;
use App\Models\Access\User\User;


class LocationController extends APIController
{

//======================== index location  ======================
public function index()
{
     $user = Location::where('user_id',auth()->user()->id)->get();
     return response()->json($user);
}
//======================== create location  ======================
public function store(Request $request)
{
   $this->validate($request,[
      'country'=> 'required',
      'city'=> 'required',
      ]);
try{

$location = new Location();

$location->create([
   'country' => $request->country,
   'city' => $request->city,
   'address' => $request->address,
   'postal_code' => $request->postal_code,
   'unit_no' => $request->unit_no,
   'state' => $request->state,
   'lng' => $request->lng,
   'lat' => $request->lat,
   'user_id' => (auth()->user()->id),
   ]);  
return response()->json("location created susseccfully!");

} catch(\Illuminate\Database\QueryException $e){
$errorCode = $e->errorInfo[1];
if($errorCode == '1062'){
   return response()->json("this location is already registered!" );
}}
}
//======================== show location  ======================

public function show($id)
{
 $location = Location::findOrFail($id);
 return response()->json($location);
}
//======================== update location  ======================

public function update(Request $request, $id)
{

       $location = Location::findOrFail($id);
       $locationData = $request->only('country','city','address','unit_no','postal_code','state','lng','lat');
       $location->update($locationData);
       return response()->json($location);
          }

//======================== delete location  ======================

public function destroy($id)
{
$location = Location::findOrFail($id);
$location -> delete();  
return response()->json("deleted successfully");

}
}
