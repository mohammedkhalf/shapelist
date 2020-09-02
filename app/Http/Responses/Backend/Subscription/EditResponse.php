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
    public function __construct($subscription,$deliveries ,$priority, $validity)
    {
        $this->subscription = $subscription;
        $this->deliveries = $deliveries;
        $this->priority = $priority;
        $this->validity = $validity;
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
        return view('backend.subscriptions.edit')->with(array(
            'subscription' => $this->subscription,
            'deliveries' => $this->deliveries,
            'priority' => $this->priority,
            'validity' => $this->validity,

        ));

    }
}