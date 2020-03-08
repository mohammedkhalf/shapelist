<?php

namespace App\Http\Responses\Backend\Platform;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Platform\Platform
     */
    protected $platforms;

    /**
     * @param App\Models\Platform\Platform $platforms
     */
    public function __construct($platforms)
    {
        $this->platforms = $platforms;
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
        return view('backend.platforms.edit')->with([
            'platforms' => $this->platforms
        ]);
    }
}