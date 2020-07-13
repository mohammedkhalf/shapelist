<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Location\Location;

class LocationController extends APIController
{
      //======================== index location  ======================
      public function index()
      {
         $userLocations = Location::where('user_id',auth()->guard('api')->user()->id)->get();
         return response()->json($userLocations);
      }
      //======================== create location  ======================
      public function store(Request $request)
      {     
            $this->validate($request,[
                  'country'=> 'string|required',
                  'city'=> 'string|required',
                  'address' => 'string|required',
                  'postal_code'=>'string|nullable',
                  'unit_no'=>'string|nullable',
                  'state'=>'string|nullable',
                  'lng'=>'string|nullable',
                  'lat'=>'string|nullable',
                  'rep_first_name'=>'string|nullable',
                  'rep_last_name'=>'string|nullable',
                  'rep_phone_number'=>'string|nullable'

               ]);

         $locationData = array_merge($request->only('country','city','address','unit_no','postal_code','state','lng','lat'
                           ,'rep_first_name','rep_last_name','rep_phone_number'),['user_id'=>auth()->guard('api')->user()->id]);
         $location = Location::create($locationData);
         return response()->json(['message'=>'location Saved susseccfully', 'location'=>$location ]);

      }
   //======================== Update location  ======================
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
         return response()->json(['message'=>'location Updated susseccfully','location'=>$location]);
      }

   //======================== delete location  ======================
      public function destroy($id)
      {
         $location = Location::findOrFail($id);
         $location->delete();  
         return response()->json("Location Deleted Successfully");
      }
}
