<?php

namespace App\Http\Controllers\Backend\Order;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\ManageOrderRequest;
use App\Models\Access\User\User;
use App\Models\Status\Status;
use App\Models\Delivery\Delivery;

/**
 * Class OrdersTableController.
 */
class OrdersTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderRepository
     */
    protected $order;

    /**
     * contructor to initialize repository object
     * @param OrderRepository $order;
     */
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    /**
     * This method return the data of the model
     * @param ManageOrderRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOrderRequest $request)
    {
            return Datatables::of($this->order->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('user_id', function ($order) {
                $username = User::where('id', $order->user_id )->pluck('first_name')->toArray();
                return $username;
            }) 
            ->addColumn('delivery_id', function ($order) {
                $devlivery = Delivery::where('id', $order->delivery_id)->pluck('name')->toArray();
                return $devlivery;
            }) 
            ->addColumn('total_price', function ($order) {
                return $order->total_price;
            }) 
            ->addColumn('status_id', function ($order) {
                $status = Status::where('id', $order->status_id )->pluck('type')->toArray();
                return $status;
            }) 
            ->addColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->toDateString();
            })
            ->addColumn('actions', function ($order) {
                return $order->action_buttons;
            })
            ->make(true);

        
       
    }
}
