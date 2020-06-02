<?php

namespace App\Http\Responses\Backend\Delivery;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Delivery\Delivery
     */
    protected $delivery;

    /**
     * @param App\Models\Delivery\Delivery $deliveries
     */
    public function __construct($delivery)
    {
        $this->delivery = $delivery;
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
        return view('backend.deliveries.edit')->with([
            'delivery' => $this->delivery
        ]);
    }
}