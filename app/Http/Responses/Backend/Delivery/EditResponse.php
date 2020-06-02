<?php

namespace App\Http\Responses\Backend\Delivery;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Delivery\Delivery
     */
    protected $deliveries;

    /**
     * @param App\Models\Delivery\Delivery $deliveries
     */
    public function __construct($deliveries)
    {
        $this->deliveries = $deliveries;
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
            'deliveries' => $this->deliveries
        ]);
    }
}