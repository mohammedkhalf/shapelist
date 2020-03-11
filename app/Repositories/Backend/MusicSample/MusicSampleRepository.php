<?php

namespace App\Repositories\Backend\MusicSample;

use DB;
use Carbon\Carbon;
use App\Models\MusicSample\MusicSample;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MusicSampleRepository.
 */
class MusicSampleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = MusicSample::class;

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
                config('module.musicsamples.table').'.id',
                config('module.musicsamples.table').'.name',
                config('module.musicsamples.table').'.url',
                config('module.musicsamples.table').'.created_at',
                config('module.musicsamples.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create($input)
    {
        $music=MusicSample::insertMusic($input);
        if ($music) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.musicsamples.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param MusicSample $musicsample
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(MusicSample $musicsample, array $input)
    {
        $updatedMusic=MusicSample::updateMusic($musicsample , $input);

    	if ($updatedMusic)
            return true;

        throw new GeneralException(trans('exceptions.backend.musicsamples.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param MusicSample $musicsample
     * @throws GeneralException
     * @return bool
     */
    public function delete(MusicSample $musicsample)
    {
        

        if ($musicsample->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.musicsamples.delete_error'));
    }
}
