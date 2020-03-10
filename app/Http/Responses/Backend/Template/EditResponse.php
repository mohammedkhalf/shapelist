<?php

namespace App\Http\Responses\Backend\Template;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Template\Template
     */
    protected $templates;

    /**
     * @param App\Models\Template\Template $templates
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
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
        return view('backend.templates.edit')->with([
            'templates' => $this->templates
        ]);
    }
}