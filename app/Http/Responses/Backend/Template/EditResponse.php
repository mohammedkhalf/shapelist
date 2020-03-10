<?php

namespace App\Http\Responses\Backend\Template;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Template\Template
     */
    protected $template;

    /**
     * @param App\Models\Template\Template $templates
     */
    public function __construct($template)
    {
        $this->template = $template;
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
            'template' => $this->template
        ]);
    }
}