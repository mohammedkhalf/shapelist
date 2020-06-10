<?php

namespace App\Repositories\Backend\Package;

use DB;
use Carbon\Carbon;
use App\Models\Package\Package;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackageRepository.
 */
class PackageRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Package::class;

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
                config('module.packages.table').'.id',
                config('module.packages.table').'.created_at',
                config('module.packages.table').'.updated_at',
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
        if (Package::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.packages.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Package $package
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Package $package, array $input)
    {
    	if ($package->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.packages.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Package $package
     * @throws GeneralException
     * @return bool
     */
    public function delete(Package $package)
    {
        if ($package->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.packages.delete_error'));
    }
}
