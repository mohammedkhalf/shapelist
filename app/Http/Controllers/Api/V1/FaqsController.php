<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\FaqsResource;
use App\Models\Faqs\Faq;
use App\Models\FaqCategory\FaqCategory;
use App\Repositories\Backend\Faqs\FaqsRepository;
use Illuminate\Http\Request;
use Validator;

class FaqsController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(FaqsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the faqs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $faqs= Faq::all();

        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        // return FaqsResource::collection(
        //     $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        // );
        return response()->json($faqs);

    }

    /**
     * Return the specified resource.
     *
     * @param Faq $faq
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Faq $faq)
    {
        return new FaqsResource($faq);
    }

    /**
     * Creates the Resource for Faq.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateFaq($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new FaqsResource(Faq::orderBy('created_at', 'desc')->first());
    }

    /**
     * Update Faq.
     *
     * @param Faq     $faq
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Faq $faq)
    {
        $validation = $this->validateFaq($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($faq, $request->all());

        $faq = Faq::findOrfail($faq->id);

        return new FaqsResource($faq);
    }

    /**
     * Delete Faq.
     *
     * @param Faq     $faq
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Faq $faq, Request $request)
    {
        $this->repository->delete($faq);

        return $this->respond([
            'message' => trans('alerts.backend.faqs.deleted'),
        ]);
    }

    /**
     * validate Faq.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateFaq(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question' => 'required|max:191',
            'answer'   => 'required',
            'question_ar' => 'required|max:191',
            'answer_ar'   => 'required',
        ]);

        return $validation;
    }

    public function category(){
        $categories= FaqCategory::all();
        return $categories;
    }

    public function general(){
        $categotyId= FaqCategory::where('name','general')->value('id');
        $faqs= Faq::where('category_id',$categotyId)->get();
        return response()->json($faqs);
    }

    public function package(){
        $categotyId= FaqCategory::where('name','package')->value('id');
        $faqs= Faq::where('category_id',$categotyId)->get();
        return response()->json($faqs);
    }
    
    public function subscription(){
        $categotyId= FaqCategory::where('name','subscription')->value('id');
        $faqs= Faq::where('category_id',$categotyId)->get();
        return response()->json($faqs);
    }
    

}
