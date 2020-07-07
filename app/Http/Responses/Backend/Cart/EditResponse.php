<?php

namespace App\Http\Responses\Backend\Cart;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Cart\Cart
     */
    protected $carts;

    /**
     * @param App\Models\Cart\Cart $carts
     */
    public function __construct($carts)
    {
        $this->carts = $carts;
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
        return view('backend.carts.edit')->with([
            'carts' => $this->carts
        ]);
    }
}