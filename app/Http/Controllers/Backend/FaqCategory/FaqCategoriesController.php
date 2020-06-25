<?php

namespace App\Http\Controllers\Backend\FaqCategory;

use App\Models\FaqCategory\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\FaqCategory\CreateResponse;
use App\Http\Responses\Backend\FaqCategory\EditResponse;
use App\Repositories\Backend\FaqCategory\FaqCategoryRepository;
use App\Http\Requests\Backend\FaqCategory\ManageFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategory\CreateFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategory\StoreFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategory\EditFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategory\UpdateFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategory\DeleteFaqCategoryRequest;

/**
 * FaqCategoriesController
 */
class FaqCategoriesController extends Controller
{
    /**
     * variable to store the repository object
     * @var FaqCategoryRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param FaqCategoryRepository $repository;
     */
    public function __construct(FaqCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\FaqCategory\ManageFaqCategoryRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageFaqCategoryRequest $request)
    {
        return new ViewResponse('backend.faqcategories.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateFaqCategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\FaqCategory\CreateResponse
     */
    public function create(CreateFaqCategoryRequest $request)
    {
        return new CreateResponse('backend.faqcategories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFaqCategoryRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreFaqCategoryRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.faqcategories.index'), ['flash_success' => trans('alerts.backend.faqcategories.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\FaqCategory\FaqCategory  $faqcategory
     * @param  EditFaqCategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\FaqCategory\EditResponse
     */
    public function edit(FaqCategory $faqcategory, EditFaqCategoryRequest $request)
    {
        return new EditResponse($faqcategory);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFaqCategoryRequestNamespace  $request
     * @param  App\Models\FaqCategory\FaqCategory  $faqcategory
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqcategory)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $faqcategory, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.faqcategories.index'), ['flash_success' => trans('alerts.backend.faqcategories.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteFaqCategoryRequestNamespace  $request
     * @param  App\Models\FaqCategory\FaqCategory  $faqcategory
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(FaqCategory $faqcategory, DeleteFaqCategoryRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($faqcategory);
        //returning with successfull message
        return new RedirectResponse(route('admin.faqcategories.index'), ['flash_success' => trans('alerts.backend.faqcategories.deleted')]);
    }
    
}
