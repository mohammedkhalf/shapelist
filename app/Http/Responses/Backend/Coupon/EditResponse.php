<?php

namespace App\Http\Responses\Backend\Coupon;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Coupon\Coupon
     */
    protected $coupon;

    /**
     * @param App\Models\Coupon\Coupon $coupons
     */
    public function __construct($coupon)
    {
        $this->coupons = $coupon;
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
        return view('backend.coupons.edit')->with([
            'coupon' => $this->coupon
        ]);
    }
}