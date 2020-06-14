<?php

namespace App\Http\Controllers\Backend\Subscription;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use App\Http\Requests\Backend\Subscription\ManageSubscriptionRequest;

/**
 * Class SubscriptionsTableController.
 */
class SubscriptionsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var SubscriptionRepository
     */
    protected $subscription;

    /**
     * contructor to initialize repository object
     * @param SubscriptionRepository $subscription;
     */
    public function __construct(SubscriptionRepository $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * This method return the data of the model
     * @param ManageSubscriptionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSubscriptionRequest $request)
    {
        return Datatables::of($this->subscription->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($subscription) {
                return Carbon::parse($subscription->created_at)->toDateString();
            })
            ->addColumn('actions', function ($subscription) {
                return $subscription->action_buttons;
            })
            ->make(true);
    }
}
