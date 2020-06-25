<?php

namespace App\Http\Responses\Backend\FaqCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\FaqCategory\FaqCategory
     */
    protected $faqcategory;

    /**
     * @param App\Models\FaqCategory\FaqCategory $faqcategories
     */
    public function __construct($faqcategory)
    {
        $this->faqcategory = $faqcategory;
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
            'faqcategory' => $this->faqcategory
        ]);
    }
}