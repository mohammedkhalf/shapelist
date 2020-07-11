<?php

namespace App\Http\Controllers\Backend\Order;

use App\Models\Order\Order;
use App\Models\Status\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Order\CreateResponse;
use App\Http\Responses\Backend\Order\EditResponse;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\ManageOrderRequest;
use App\Http\Requests\Backend\Order\CreateOrderRequest;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\EditOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Http\Requests\Backend\Order\DeleteOrderRequest; 
use App\Http\Requests\Backend\Order\ViewOrderRequest; 
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use PDF;
/**
 * OrdersController
 */
class OrdersController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param OrderRepository $repository;
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Order\ManageOrderRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageOrderRequest $request)
    {
       
        return new ViewResponse('backend.orders.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateOrderRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Order\CreateResponse
     */
    public function create(CreateOrderRequest $request)
    {
        return new CreateResponse('backend.orders.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrderRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Order\Order  $order
     * @param  EditOrderRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Order\EditResponse
     */
    public function edit(Order $order, EditOrderRequest $request)
    {
        $statusesData =  Status::all();
        $selectedID = Status::first()->id;
        return new ViewResponse('backend.orders.edit', compact('order','statusesData','selectedID'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrderRequestNamespace  $request
     * @param  App\Models\Order\Order  $order
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $orderInfo = Order::updateAdminOrder($order,$request);
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteOrderRequestNamespace  $request
     * @param  App\Models\Order\Order  $order
     * @return \App\Http\Responses\RedirectResponse
     */

    public function show(ViewOrderRequest $request , Order $order)
    {
        
        $numProducts = OrderItem::where('order_id',$order->id)->count();
        $numPackages = OrderPackage::where('order_id',$order->id)->count();
        $totalCount = $numProducts + $numPackages;
        $userProducts = Order::with('products','location')->where('id',$order->id)->get();
        $productsData = OrderItem::where('order_id',$order->id)->get();
        $packageData =  OrderPackage::where('order_id',$order->id)->get();
        if(is_null($order))
        {
            return back();
        }  

        return new ViewResponse('backend.orders.view', compact('packageData','order','totalCount','userProducts','productsData'));
    }

    public function destroy(Order $order, DeleteOrderRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($order);
        //returning with successfull message
        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => trans('alerts.backend.orders.deleted')]);
    }

    public function preivewOrder (Order $OrderObject)
    {
       Order::viewPDF($OrderObject);
    }
    
}
