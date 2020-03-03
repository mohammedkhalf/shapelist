<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coupons;

class CouponController extends Controller
{

    //======================== index coupon  ======================
    public function index()
    {
        $coupon = coupons::all();
        return response()->json($coupon);
    }

    //======================== create coupon  ======================
    public function store(Request $request)
    {

    try{
        $coupon = new coupons;
        $coupon->code= $request->code;
        $coupon->amount= $request->amount;
        $coupon->quantity= $request->quantity;
       // $coupon->valid= $request->valid;

        $coupon->save();
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
        $coupon = coupons::findOrFail($id);
        return response()->json($coupon);
    }


    //======================== update coupon  ======================

    public function update(Request $request, $id)
    {
       
                    $coupon = coupons::findOrFail($id);
                    $coupon->code= $request->code;
                    $coupon->amount= $request->amount;
                    $coupon->quantity= $request->quantity;
                    $coupon->valid= $request->valid;
                    $coupon->save();
                    return response()->json($coupon);
                 }

    //======================== delete coupon  ======================

    public function destroy($id)
    {
        $coupon = coupons::findOrFail($id);
        $coupon -> delete();  
        return response()->json("deleted successfully");
 
     }
    }
