<?php

namespace App\Http\Responses\Backend\Promotion;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Promotion\Promotion
     */
    protected $promotions;

    /**
     * @param App\Models\Promotion\Promotion $promotions
     */
    public function __construct($promotions)
    {
        $this->promotions = $promotions;
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
        return view('backend.promotions.edit')->with([
            'promotions' => $this->promotions
        ]);
    }
}