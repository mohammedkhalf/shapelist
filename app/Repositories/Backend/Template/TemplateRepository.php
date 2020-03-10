<?php

namespace App\Repositories\Backend\Template;

use DB;
use Carbon\Carbon;
use App\Models\Template\Template;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateRepository.
 */
class TemplateRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Template::class;

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
                config('module.templates.table').'.id',
                config('module.templates.table').'.name',
                config('module.templates.table').'.image',
                config('module.templates.table').'.created_at',
                config('module.templates.table').'.updated_at',
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
        $template = Template::insertTemplate($input);
        if (!is_null($template)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.templates.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Template $template
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Template $template, array $input)
    {
        $template = Template::updateTemplate($template,$input);

        if (!is_null($template)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.templates.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Template $template
     * @throws GeneralException
     * @return bool
     */
    public function delete(Template $template)
    {
        if ($template->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.templates.delete_error'));
    }
}
