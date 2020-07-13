<?php

namespace App\Http\Controllers\Api\V1;

use Storage;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderFront;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Models\Payment\Payment;
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use App\Models\Invoice\Invoice;

class OrderController extends APIController
{
    
        //======================== index orders  ======================
        public function index()
        {
            $allOrders = Order::with('products','location')->where('user_id',auth()->guard('api')->user()->id)->get();
            return response()->json(json_decode($allOrders));   
        } 
        //======================== create order StoreOrderRequest  ======================
        public function store(Request $request)
        {
        }

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

        public function getMedia($id)
        {
            $order = Order::findOrFail($id);
            if($order->download_file)
            {
               return response()->download(storage_path("app/public/orders-download/{$order->download_file}"));
            }
            return response()->json(['message'=>'There Is No Media File']);          
        }

        public function savePaymentInfo(StoreOrderRequest $request)
        {     
            // 1 payment successs
            if($request->status == 1 && !empty($request->bank_transaction_id))
            {    
                $orderObj = Order::CreteOrderRequest($request);
                OrderItem::where('user_id','=', $orderObj->user_id)->update(['order_id'=>$orderObj->id]);
                OrderPackage::where('user_id','=', $orderObj->user_id)->update(['order_id'=>$orderObj->id]);
                Payment::create(array_merge($request->only('bank_transaction_id','status'),['order_id'=> $orderObj ->id]));
                $InvoiceEmail=Order::sendPdfInvoice($orderObj);
                return response()->json(['message'=>'Payment Process Successfully']);
            }
            // Failure
            return response()->json(['message'=>'Payment Process  Failure']);
        }
        //======================== download S3 ===========================
        public function orderDownload($fileName)
        {
           $url = Storage::disk('s3')->url('media_files/'.$fileName);
           return $url;
        }

        //download Invoice
        public function downloadInvoice($orderId)
        {
            $invoiceObj = Invoice::where('order_id',$orderId)->first();
            $user_id = auth()->guard('api')->user()->id;
            return response()->download(storage_path("app/orders-pdf/{$user_id}/{$orderId}/{$invoiceObj->file_name}"));
        }
        
}
