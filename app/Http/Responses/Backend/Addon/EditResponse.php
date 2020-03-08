<?php

namespace App\Http\Responses\Backend\Addon;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Addon\Addon
     */
    protected $addons;

    /**
     * @param App\Models\Addon\Addon $addons
     */
    public function __construct($addons)
    {
        $this->addons = $addons;
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
        return view('backend.addons.edit')->with([
            'addons' => $this->addons
        ]);
    }
}