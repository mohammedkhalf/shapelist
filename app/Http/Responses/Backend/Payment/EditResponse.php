<?php

namespace App\Http\Responses\Backend\Payment;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Payment\Payment
     */
    protected $payments;

    /**
     * @param App\Models\Payment\Payment $payments
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.payments.edit')->with([
            'payments' => $this->payments
        ]);
    }
}