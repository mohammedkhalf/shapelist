<?php

namespace App\Repositories\Backend\FaqCategory;

use DB;
use Carbon\Carbon;
use App\Models\FaqCategory\FaqCategory;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqCategoryRepository.
 */
class FaqCategoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = FaqCategory::class;

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
                config('module.faqcategories.table').'.id',
<<<<<<< HEAD
=======
                config('module.faqcategories.table').'.name',
>>>>>>> origin/develop
                config('module.faqcategories.table').'.created_at',
                config('module.faqcategories.table').'.updated_at',
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
        if (FaqCategory::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.faqcategories.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param FaqCategory $faqcategory
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(FaqCategory $faqcategory, array $input)
    {
    	if ($faqcategory->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.faqcategories.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param FaqCategory $faqcategory
     * @throws GeneralException
     * @return bool
     */
    public function delete(FaqCategory $faqcategory)
    {
        if ($faqcategory->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.faqcategories.delete_error'));
    }
}
