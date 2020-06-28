<?php

namespace App\Http\Responses\Backend\Faq;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Faqs\Faq
     */
    protected $faq ,$categories;

    /**
     * @param \App\Models\Faqs\Faq $faq
     */
    public function __construct($faq, $categories)
    {
        $this->faq = $faq;
        $this->categories = $categories;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.faqs.edit')
            ->with(array('faq'=> $this->faq ,'categories'=>$this->categories));
    }
}
