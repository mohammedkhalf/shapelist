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
     $user = User::findOrFail($user_id)->locations()->get();
     return response()->json($user);
}
//======================== create location  ======================
public function store(Request $request)
{

try{

$user = User::findOrFail($user_id);

$user->locations()->create([
   'country' => $request->country,
   'city' => $request->city,
   'address' => $request->address,
   'postal_code' => $request->postal_code,
   'unit_no' => $request->unit_no,
   'state' => $request->state,
   'lng' => $request->lng,
   'lat' => $request->lat,
    ]);  


$user->save();
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
       $location->country= $request->country;
       $location->city= $request->city;
       $location->address= $request->address;
       $location->postal_code= $request->postal_code;
       $location->unit_no= $request->unit_no;
       $location->state= $request->state;
       $location->lng= $request->lng;
       $location->lat= $request->lat;

             $location->save();

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
