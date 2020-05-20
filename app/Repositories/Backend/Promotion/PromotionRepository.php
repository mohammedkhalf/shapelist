<?php

namespace App\Repositories\Backend\Promotion;

use DB;
use Carbon\Carbon;
use App\Models\Promotion\Promotion;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromotionRepository.
 */
class PromotionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Promotion::class;

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
                config('module.promotions.table').'.id',
                config('module.promotions.table').'.created_at',
                config('module.promotions.table').'.updated_at',
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
        if (Promotion::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.promotions.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Promotion $promotion
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Promotion $promotion, array $input)
    {
    	if ($promotion->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.promotions.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Promotion $promotion
     * @throws GeneralException
     * @return bool
     */
    public function delete(Promotion $promotion)
    {
        if ($promotion->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.promotions.delete_error'));
    }
}
