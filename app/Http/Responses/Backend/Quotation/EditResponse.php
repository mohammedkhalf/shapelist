<?php

namespace App\Http\Responses\Backend\Quotation;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Quotation\Quotation
     */
    protected $quotation;

    /**
     * @param App\Models\Quotation\Quotation $quotations
     */
    public function __construct($quotation)
    {
        $this->quotation = $quotation;
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
        return view('backend.quotations.edit')->with([
            'quotation' => $this->quotation
        ]);
    }
}