<?php

namespace App\Repositories\Backend\Subscription;

use DB;
use Carbon\Carbon;
use App\Models\Subscription\Subscription;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionRepository.
 */
class SubscriptionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Subscription::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.subscriptions.table').'.id',
                config('module.subscriptions.table').'.name',
                config('module.subscriptions.table').'.purchase_points',
                config('module.subscriptions.table').'.free_points',
                config('module.subscriptions.table').'.discount',
                config('module.subscriptions.table').'.details',
                config('module.subscriptions.table').'.duration',
                config('module.subscriptions.table').'.price',
                config('module.subscriptions.table').'.created_at',
                config('module.subscriptions.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        if (Subscription::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.subscriptions.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Subscription $subscription
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Subscription $subscription, array $input)
    {
    	if ($subscription->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.subscriptions.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Subscription $subscription
     * @throws GeneralException
     * @return bool
     */
    public function delete(Subscription $subscription)
    {
        if ($subscription->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.subscriptions.delete_error'));
    }
}
