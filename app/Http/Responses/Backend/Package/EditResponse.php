<?php

namespace App\Http\Responses\Backend\Package;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Package\Package
     */
    protected $packages;

    /**
     * @param App\Models\Package\Package $packages
     */
    public function __construct($packages)
    {
        $this->packages = $packages;
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
        return view('backend.packages.edit')->with([
            'packages' => $this->packages
        ]);
    }
}