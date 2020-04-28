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
            if(Location::where('id','=',$request->id)->first())
            {
               return response()->json("location Already susseccfully!");
            }
         
            $this->validate($request,[
                  'country'=> 'string|required',
                  'city'=> 'string|required',
                  'address'=>'string|nullable',
                  'postal_code'=>'string|nullable',
                  'unit_no'=>'string|nullable',
                  'lng'=>'string|nullable',
                  'lat'=>'string|nullable',
                  'rep_first_name'=>'string|nullable',
                  'rep_last_name'=>'string|nullable',
                  'rep_phone_number'=>'string|nullable',

               ]);
            $location = new Location();
            $LocationInfo = $request->only('country','city','address','postal_code','unit_no',
                                    'lng','lat','rep_first_name','rep_last_name','rep_phone_number');
            $LocationArray = array_merge($LocationInfo , ['user_id'=>auth()->user()->id]);
            $location = Location::create($LocationArray);
            return response()->json([
                     'message'=>'location created susseccfully',
                     'location' => $location
            ]);
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
               'country'=> 'string|required',
               'city'=> 'string|required',
               'address'=>'string|nullable',
               'postal_code'=>'string|nullable',
               'unit_no'=>'string|nullable',
               'lng'=>'string|nullable',
               'lat'=>'string|nullable',
               'rep_first_name'=>'string|nullable',
               'rep_last_name'=>'string|nullable',
               'rep_phone_number'=>'string|nullable',
            ]);
         $location = Location::findOrFail($id);
         $locationData = $request->only('country','city','address','unit_no',
                                 'postal_code','lng','lat','rep_first_name','rep_last_name','rep_phone_number');
         $location->update($locationData);
         return response()->json(['message'=>'location created susseccfully','location'=>$location]);
      }

   //======================== delete location  ======================

      public function destroy($id)
      {
         $location = Location::findOrFail($id);
         $location->delete();  
         return response()->json("Location Deleted Successfully");
      }
}
