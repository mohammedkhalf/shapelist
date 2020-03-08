<?php

namespace App\Http\Responses\Backend\Coupon;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Coupon\Coupon
     */
    protected $coupons;

    /**
     * @param App\Models\Coupon\Coupon $coupons
     */
    public function __construct($coupons)
    {
        $this->coupons = $coupons;
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
            'coupons' => $this->coupons
        ]);
    }
}