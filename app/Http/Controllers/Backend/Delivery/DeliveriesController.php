<?php

namespace App\Http\Controllers\Backend\Delivery;

use App\Models\Delivery\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Delivery\CreateResponse;
use App\Http\Responses\Backend\Delivery\EditResponse;
use App\Repositories\Backend\Delivery\DeliveryRepository;
use App\Http\Requests\Backend\Delivery\ManageDeliveryRequest;
use App\Http\Requests\Backend\Delivery\CreateDeliveryRequest;
use App\Http\Requests\Backend\Delivery\StoreDeliveryRequest;
use App\Http\Requests\Backend\Delivery\EditDeliveryRequest;
use App\Http\Requests\Backend\Delivery\UpdateDeliveryRequest;
use App\Http\Requests\Backend\Delivery\DeleteDeliveryRequest;
use App\Models\Order\Order;

/**
 * DeliveriesController
 */
class DeliveriesController extends Controller
{
    /**
     * variable to store the repository object
     * @var DeliveryRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param DeliveryRepository $repository;
     */
    public function __construct(DeliveryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Delivery\ManageDeliveryRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageDeliveryRequest $request)
    {
        Delivery::where('id',1)->update(['counter'=>Order::with('delivery')->where('delivery_id',1)->count()]);
        Delivery::where('id',2)->update(['counter'=>Order::with('delivery')->where('delivery_id',2)->count()]);
        Delivery::where('id',3)->update(['counter'=>Order::with('delivery')->where('delivery_id',3)->count()]);
        return new ViewResponse('backend.deliveries.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateDeliveryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Delivery\CreateResponse
     */
    public function create(CreateDeliveryRequest $request)
    {
        return new CreateResponse('backend.deliveries.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDeliveryRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreDeliveryRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.deliveries.index'), ['flash_success' => trans('alerts.backend.deliveries.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Delivery\Delivery  $delivery
     * @param  EditDeliveryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Delivery\EditResponse
     */
    public function edit(Delivery $delivery, EditDeliveryRequest $request)
    {
        return new EditResponse($delivery);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDeliveryRequestNamespace  $request
     * @param  App\Models\Delivery\Delivery  $delivery
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $delivery, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.deliveries.index'), ['flash_success' => trans('alerts.backend.deliveries.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteDeliveryRequestNamespace  $request
     * @param  App\Models\Delivery\Delivery  $delivery
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Delivery $delivery, DeleteDeliveryRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($delivery);
        //returning with successfull message
        return new RedirectResponse(route('admin.deliveries.index'), ['flash_success' => trans('alerts.backend.deliveries.deleted')]);
    }
    
}
