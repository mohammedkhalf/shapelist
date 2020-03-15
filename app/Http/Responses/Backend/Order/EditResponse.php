<?php

namespace App\Http\Responses\Backend\Order;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Order\Order
     */
    protected $order;

    /**
     * @param App\Models\Order\Order $orders
     */
    public function __construct($order)
    {
        $this->order = $order;
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
        return view('backend.orders.edit')->with([
            'order' => $this->order
        ]);
    }
}