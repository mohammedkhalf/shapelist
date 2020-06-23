<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Models\Order\Order;
class InvoiceController extends Controller
{

    public function sendPdfInvoice() {
        $orderData= Order::with('products','package')->get();
        dd($orderData);
        $data["email"]="khalaf@sparkle.sa";
        $data["client_name"]="mohammed khalf";
        $data["subject"]="Purchase Invoice";
        //order data
        $data["order_id"] = $orderData->id;
        $data["total_price"] = $orderData->total_price;
        $data["coupon_code"] = $orderData->coupon_code;

        $pdf = PDF::loadView('emails.email-invoice', $data);

            try{
                Mail::send('emails.email-body',$data,function($message)use($data,$pdf) {
                $message->to($data["email"], $data["client_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "invoice.pdf");
                });
            }catch(JWTException $exception){
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail";
                $this->statuscode  =   "0";

            }else{

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
            }
            return response()->json(compact('this'));

    }
}
