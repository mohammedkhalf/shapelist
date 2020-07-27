<?php

namespace App\Http\Controllers\Backend\Delivery;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Delivery\DeliveryRepository;
use App\Http\Requests\Backend\Delivery\ManageDeliveryRequest;
use App\Models\Order\Order;

/**
 * Class DeliveriesTableController.
 */
class DeliveriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var DeliveryRepository
     */
    protected $delivery;

    /**
     * contructor to initialize repository object
     * @param DeliveryRepository $delivery;
     */
    public function __construct(DeliveryRepository $delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * This method return the data of the model
     * @param ManageDeliveryRequest $request  
     *
     * @return mixed
     */
    public function __invoke(ManageDeliveryRequest $request)
    {
        return Datatables::of($this->delivery->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('counter', function ($delivery) {
                return $delivery->counter;
            })
            ->addColumn('created_at', function ($delivery) {
                return Carbon::parse($delivery->created_at)->toDateString();
            })
            ->addColumn('actions', function ($delivery) {
                return $delivery->action_buttons;
            })
            ->make(true);
    }
}
