<?php

namespace App\Http\Controllers\Backend\Quotation;

use App\Models\Quotation\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Quotation\CreateResponse;
use App\Http\Responses\Backend\Quotation\EditResponse;
use App\Repositories\Backend\Quotation\QuotationRepository;
use App\Http\Requests\Backend\Quotation\ManageQuotationRequest;
use App\Http\Requests\Backend\Quotation\CreateQuotationRequest;
use App\Http\Requests\Backend\Quotation\StoreQuotationRequest;
use App\Http\Requests\Backend\Quotation\EditQuotationRequest;
use App\Http\Requests\Backend\Quotation\UpdateQuotationRequest;
use App\Http\Requests\Backend\Quotation\DeleteQuotationRequest;

/**
 * QuotationsController
 */
class QuotationsController extends Controller
{
    /**
     * variable to store the repository object
     * @var QuotationRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param QuotationRepository $repository;
     */
    public function __construct(QuotationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Quotation\ManageQuotationRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageQuotationRequest $request)
    {
        return new ViewResponse('backend.quotations.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateQuotationRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Quotation\CreateResponse
     */
    public function create(CreateQuotationRequest $request)
    {
        return new CreateResponse('backend.quotations.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuotationRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreQuotationRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.quotations.index'), ['flash_success' => trans('alerts.backend.quotations.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Quotation\Quotation  $quotation
     * @param  EditQuotationRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Quotation\EditResponse
     */
    public function edit(Quotation $quotation, EditQuotationRequest $request)
    {
        return new EditResponse($quotation);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateQuotationRequestNamespace  $request
     * @param  App\Models\Quotation\Quotation  $quotation
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $quotation, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.quotations.index'), ['flash_success' => trans('alerts.backend.quotations.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteQuotationRequestNamespace  $request
     * @param  App\Models\Quotation\Quotation  $quotation
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Quotation $quotation, DeleteQuotationRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($quotation);
        //returning with successfull message
        return new RedirectResponse(route('admin.quotations.index'), ['flash_success' => trans('alerts.backend.quotations.deleted')]);
    }
    
}
