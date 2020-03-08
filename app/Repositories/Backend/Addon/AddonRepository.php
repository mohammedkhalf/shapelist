<?php

namespace App\Repositories\Backend\Addon;

use DB;
use Carbon\Carbon;
use App\Models\Addon\Addon;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddonRepository.
 */
class AddonRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Addon::class;

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
                config('module.addons.table').'.id',
                config('module.addons.table').'.name',
                config('module.addons.table').'.type',
                config('module.addons.table').'.price',
                config('module.addons.table').'.created_at',
                config('module.addons.table').'.updated_at',
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
        if (Addon::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.addons.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Addon $addon
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Addon $addon, array $input)
    {
    	if ($addon->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.addons.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Addon $addon
     * @throws GeneralException
     * @return bool
     */
    public function delete(Addon $addon)
    {
        if ($addon->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.addons.delete_error'));
    }
}
