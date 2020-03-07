<?php


namespace App\Http\Controllers\Api\V1;
use App\Models\OrderStatus\OrderStatus;

use Illuminate\Http\Request;

class OrderStatusController extends APIController
{
    
    //======================== index orders_status  ======================
    public function index()
    {
        $orders_status = OrderStatus::all();
        return response()->json($orders_status);
    }

    //======================== create orders_status ======================
    public function store(Request $request)
    {
try{
        $orders_status = new OrderStatus;
        $orders_status->name= $request->name;
        $orders_status->save();
        return response()->json($orders_status);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this orders_status is already registered!" );
        }}
    }

    //======================== show orders_status  ======================
    
    public function show($id)
    {
        $orders_status = OrderStatus::findOrFail($id);
        return response()->json($orders_status);
    }


    //======================== update orders_status  ======================

    public function update(Request $request, $id)
    {
       
              
                    $orders_status = OrderStatus::findOrFail($id);
                    $orders_status->name= $request->name;
                    $orders_status->save();

                    return response()->json($orders_status);
                 }

    //======================== delete orders_status  ======================

    public function destroy($id)
    {
        $orders_status = OrderStatus::findOrFail($id);
        $orders_status -> delete();  
        return response()->json("deleted successfully");
 
     }  
}
