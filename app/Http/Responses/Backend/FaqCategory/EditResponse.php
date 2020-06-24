<?php

namespace App\Http\Responses\Backend\FaqCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\FaqCategory\FaqCategory
     */
    protected $faqcategories;

    /**
     * @param App\Models\FaqCategory\FaqCategory $faqcategories
     */
    public function __construct($faqcategories)
    {
        $this->faqcategories = $faqcategories;
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
        return view('backend.faqcategories.edit')->with([
            'faqcategories' => $this->faqcategories
        ]);
    }
}