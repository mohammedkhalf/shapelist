<?php

namespace App\Http\Controllers\Backend\Promotion;

use App\Models\Promotion\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Promotion\CreateResponse;
use App\Http\Responses\Backend\Promotion\EditResponse;
use App\Repositories\Backend\Promotion\PromotionRepository;
use App\Http\Requests\Backend\Promotion\ManagePromotionRequest;
use App\Http\Requests\Backend\Promotion\CreatePromotionRequest;
use App\Http\Requests\Backend\Promotion\StorePromotionRequest;
use App\Http\Requests\Backend\Promotion\EditPromotionRequest;
use App\Http\Requests\Backend\Promotion\UpdatePromotionRequest;
use App\Http\Requests\Backend\Promotion\DeletePromotionRequest;

/**
 * PromotionsController
 */
class PromotionsController extends Controller
{
    /**
     * variable to store the repository object
     * @var PromotionRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param PromotionRepository $repository;
     */
    public function __construct(PromotionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Promotion\ManagePromotionRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePromotionRequest $request)
    {
        return new ViewResponse('backend.promotions.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreatePromotionRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Promotion\CreateResponse
     */
    public function create(CreatePromotionRequest $request)
    {
        return new CreateResponse('backend.promotions.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePromotionRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePromotionRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.promotions.index'), ['flash_success' => trans('alerts.backend.promotions.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Promotion\Promotion  $promotion
     * @param  EditPromotionRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Promotion\EditResponse
     */
    public function edit(Promotion $promotion, EditPromotionRequest $request)
    {
        return new EditResponse($promotion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePromotionRequestNamespace  $request
     * @param  App\Models\Promotion\Promotion  $promotion
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $promotion, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.promotions.index'), ['flash_success' => trans('alerts.backend.promotions.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePromotionRequestNamespace  $request
     * @param  App\Models\Promotion\Promotion  $promotion
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Promotion $promotion, DeletePromotionRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($promotion);
        //returning with successfull message
        return new RedirectResponse(route('admin.promotions.index'), ['flash_success' => trans('alerts.backend.promotions.deleted')]);
    }
    
}
