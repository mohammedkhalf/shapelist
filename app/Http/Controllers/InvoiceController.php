<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Models\Order\Order;
class InvoiceController extends Controller
{
    public function getInvoice()
    {
        return view("emails.email-invoice");
    }
    // public function sendPdfInvoice() 
    // {
    //     $orderData = Order::getOrderinformation();
    //     $data=["email"=>"khalaf@sparkle.sa","client_name"=>"mohammed khalf","subject"=>"Purchase Invoice"];
    //     $pdf = PDF::loadView('emails.email-invoice', $data);
    //         try
    //         {
    //             Mail::send('emails.email-body',$data,function($message)use($data,$pdf) {
    //             $message->to($data["email"], $data["client_name"])
    //                     ->subject($data["subject"])
    //                     ->attachData($pdf->output(),"invoice.pdf");
    //             });
    //         }catch(JWTException $exception){
    //             $this->serverstatuscode = "0";
    //             $this->serverstatusdes = $exception->getMessage();
    //         }
    //         if (Mail::failures()) {
    //             $this->statusdesc  =   "Error sending mail";
    //             $this->statuscode  =   "0";
    //         }else{
    //         $this->statusdesc  =   "Message sent Succesfully";
    //         $this->statuscode  =   "1";
    //         }
    //         return response()->json(compact('this'));
    // }
}
