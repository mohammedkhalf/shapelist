<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Coupon\Coupon;

class CouponController extends APIController
{

    //======================== index coupon  ======================
    public function index()
    {
        $coupon = Coupon::all();
        return response()->json($coupon);
    }

    //======================== create coupon  ======================
    public function store(Request $request)
    {

    try{
        $coupon = $request->only('code','amount');
        Coupon::create($coupon);
        return response()->json($coupon);
    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this coupon is already registered!" );
        }}
    }

    //======================== show coupon  ======================
    
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return response()->json($coupon);
    }


    //======================== update coupon  ======================

    public function update(Request $request, $id)
    {
       
        $coupon = Coupon::findOrFail($id);
        $couponData = $request->only('code','amount','valid');
        $coupon->update($couponData);
        return response()->json($coupon); }

    //======================== delete coupon  ======================

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon -> delete();  
        return response()->json("deleted successfully");
 
     }
    }
