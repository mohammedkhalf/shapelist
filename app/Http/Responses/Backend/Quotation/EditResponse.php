<?php

namespace App\Http\Responses\Backend\Quotation;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Quotation\Quotation
     */
    protected $quotations;

    /**
     * @param App\Models\Quotation\Quotation $quotations
     */
    public function __construct($quotations)
    {
        $this->quotations = $quotations;
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
            'quotations' => $this->quotations
        ]);
    }
}