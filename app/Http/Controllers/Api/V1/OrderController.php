<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Models\Payment\Payment;

class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index()
        {
            $allOrders = Order::with('products','location')->where('user_id',auth()->guard('api')->user()->id)->get();
            return response()->json(json_decode($allOrders));   
        } 
        //======================== create order  ======================
        public function store(StoreOrderRequest $request)
        {
            $orderInfo=Order::insertOrder($request); 
            return response()->json(['orderInfo'=> json_decode($orderInfo) ,'message' => 'Order Created Successfully']);
        }
        //======================== show order  ======================

        public function show($id)
        {
            $order = Order::findOrFail($id);
            $orderInfo = Order::with('products','location')->where(['id'=>$id,'user_id'=>auth()->guard('api')->user()->id])->get();
            if(is_null($orderInfo)){
                return back();
            } 
            $responseCheckout = Order::prepareCheckout($order->total_price);
            return response()->json(['order'=> $orderInfo ,'responseCheckout'=>json_decode($responseCheckout)]);
        }
        //======================== update order  ======================

        public function update(UpdateOrderRequest $request, $id)
        {   
            $updatedOrder=Order::updateOrder($request,$id);
            return response()->json(['updatedOrder'=>$updatedOrder ,'message' => 'Order updated successfully!']);
        }
        //======================== delete order  ======================

        public function destroy($id)
        {
            $order = Order::findOrFail($id);
            if(!is_null($order))
            {
                $order->delete();  
                return response()->json("Order deleted successfully");
            }
            return response()->json("This Order Not Found");
        }

        public function getStatus ($checkoutId)
        {
            $responseData = Order::getStatus($checkoutId);
            return response()->json(['responseData'=>json_decode($responseData)]);          
        }

        public function getMedia($id)
        {
            $order = Order::findOrFail($id);
            if($order->download_file)
            {
               return response()->download(storage_path("app/public/orders-download/{$order->download_file}"));
            }
            return response()->json(['message'=>'There Is No Media File']);          
        }

        public function savePaymentInfo(Request $request)
        {     
            // 1 payment successs
            if($request->status == 1)
            {           
                $orderObj = Order::findOrFail($request->order_id);
                Payment::create($request->only('order_id','bank_transaction_id','status'));
                $InvoiceEmail=Order::sendPdfInvoice($orderObj);
                return response()->json(['message'=>'Payment Process Successfully']);
            }
            // Failure
            return response()->json(['message'=>'Payment Process  Failure']);
        }
}
