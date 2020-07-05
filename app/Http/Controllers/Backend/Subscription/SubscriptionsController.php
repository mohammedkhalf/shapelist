<?php

namespace App\Http\Controllers\Backend\Subscription;

use App\Models\Access\User\User;
use App\Models\Subscription\Subscription;
use App\Models\Delivery\Delivery;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Subscription\CreateResponse;
use App\Http\Responses\Backend\Subscription\EditResponse;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use App\Http\Requests\Backend\Subscription\ManageSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\EditSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\UpdateSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\DeleteSubscriptionRequest;

/**
 * SubscriptionsController
 */
class SubscriptionsController extends Controller
{
    /**
     * variable to store the repository object
     * @var SubscriptionRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param SubscriptionRepository $repository;
     */
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Subscription\ManageSubscriptionRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageSubscriptionRequest $request)
    {
        return new ViewResponse('backend.subscriptions.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateSubscriptionRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Subscription\CreateResponse
     */
    public function create(CreateSubscriptionRequest $request)
    {
        $deliveries = Delivery::all();
        return new ViewResponse('backend.subscriptions.create',['deliveries'=>$deliveries]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubscriptionRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreSubscriptionRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.subscriptions.index'), ['flash_success' => trans('alerts.backend.subscriptions.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Subscription\Subscription  $subscription
     * @param  EditSubscriptionRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Subscription\EditResponse
     */
    public function edit(Subscription $subscription, EditSubscriptionRequest $request)
    {
        $deliveries = Delivery::all();
        $priority = Subscription::where('id',$subscription->id)->value('priority_support');
        return new EditResponse($subscription,$deliveries,$priority);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubscriptionRequestNamespace  $request
     * @param  App\Models\Subscription\Subscription  $subscription
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $subscription, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.subscriptions.index'), ['flash_success' => trans('alerts.backend.subscriptions.updated')]);
    }
    public function subscribers($id)
    {
        $subscriber = Subscription::with('subscription')->where('id',$id)->get();
        return new ViewResponse('backend.subscriptions.subscriptionDetails',compact('subscriber'));
    }

    public function removesubscriber($id)
    {
        $unSubscribeUsers = SubscriptionDetail::findOrFail($id)->first();
        $unSubscribeUsers->delete();
        return new RedirectResponse(route('admin.subscriptions.index'), ['flash_success' => 'Subscriber has been deleted successfully']);
    }

    public function unsubscribers(){
        $unSubscribeUsers = SubscriptionDetail::with('user')->where('subscription_id',null)->get();
        return new ViewResponse('backend.subscriptions.unsubscribers',compact('unSubscribeUsers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteSubscriptionRequestNamespace  $request
     * @param  App\Models\Subscription\Subscription  $subscription
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Subscription $subscription, DeleteSubscriptionRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($subscription);
        //returning with successfull message
        return new RedirectResponse(route('admin.subscriptions.index'), ['flash_success' => trans('alerts.backend.subscriptions.deleted')]);
    }
    
}
