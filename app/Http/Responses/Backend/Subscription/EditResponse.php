<?php

namespace App\Http\Responses\Backend\Subscription;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Subscription\Subscription
     */
    protected $subscription;

    /**
     * @param App\Models\Subscription\Subscription $subscriptions
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
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
        return view('backend.subscriptions.edit')->with([
            'subscription' => $this->subscription
        ]);
    }
}