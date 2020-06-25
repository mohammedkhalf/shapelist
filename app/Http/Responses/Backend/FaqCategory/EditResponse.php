<?php

namespace App\Http\Responses\Backend\FaqCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\FaqCategory\FaqCategory
     */
<<<<<<< HEAD
    protected $faqcategories;
=======
    protected $faqcategory;
>>>>>>> origin/develop

    /**
     * @param App\Models\FaqCategory\FaqCategory $faqcategories
     */
<<<<<<< HEAD
    public function __construct($faqcategories)
    {
        $this->faqcategories = $faqcategories;
=======
    public function __construct($faqcategory)
    {
        $this->faqcategory = $faqcategory;
>>>>>>> origin/develop
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
<<<<<<< HEAD
            'faqcategories' => $this->faqcategories
=======
            'faqcategory' => $this->faqcategory
>>>>>>> origin/develop
        ]);
    }
}