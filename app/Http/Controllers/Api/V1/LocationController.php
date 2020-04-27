<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Location\Location;


class LocationController extends APIController
{

      //======================== index location  ======================
      public function index()
      {
         $userLocations = Location::where('user_id',auth()->user()->id)->get();
         return response()->json($userLocations);
      }
      //======================== create location  ======================
      public function store(Request $request)
      {     
            if(Location::where('user_id','=',auth()->user()->id)->first())
            {
               return response()->json("location Already susseccfully!");
            }
         
            $this->validate($request,[
                  'country'=> 'string|required',
                  'city'=> 'string|required',
               ]);
            $location = new Location();
            $LocationInfo = $request->only('country','city','address','postal_code','unit_no','state','lng','lat');
            $LocationArray = array_merge($LocationInfo , ['user_id'=>auth()->user()->id]);
            $location->update($LocationArray);
            return response()->json("location created susseccfully!");
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
         $this->validate($request,[
            'country'=> 'required',
            'city'=> 'required',
            ]);

         $location = Location::findOrFail($id);
         $locationData = $request->only('country','city','address','unit_no','postal_code','state','lng','lat');
         $location->update($locationData);
         return response()->json($location);
      }

   //======================== delete location  ======================

      public function destroy($id)
      {
         $location = Location::findOrFail($id);
         $location->delete();  
         return response()->json("Location deleted successfully");
      }
}
