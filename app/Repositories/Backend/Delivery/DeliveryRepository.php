<?php

namespace App\Repositories\Backend\Delivery;

use DB;
use Carbon\Carbon;
use App\Models\Delivery\Delivery;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryRepository.
 */
class DeliveryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Delivery::class;

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
                config('module.deliveries.table').'.id',
                config('module.deliveries.table').'.name',
                config('module.deliveries.table').'.price',
                config('module.deliveries.table').'.created_at',
                config('module.deliveries.table').'.updated_at',
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
        if (Delivery::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.deliveries.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Delivery $delivery
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Delivery $delivery, array $input)
    {
    	if ($delivery->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.deliveries.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Delivery $delivery
     * @throws GeneralException
     * @return bool
     */
    public function delete(Delivery $delivery)
    {
        if ($delivery->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.deliveries.delete_error'));
    }
}
