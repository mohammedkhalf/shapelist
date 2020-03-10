<?php

namespace App\Http\Controllers\Backend\Template;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Template\TemplateRepository;
use App\Http\Requests\Backend\Template\ManageTemplateRequest;
use Storage;

/**
 * Class TemplatesTableController.
 */
class TemplatesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var TemplateRepository
     */
    protected $template;

    /**
     * contructor to initialize repository object
     * @param TemplateRepository $template;
     */
    public function __construct(TemplateRepository $template)
    {
        $this->template = $template;
    }

    /**
     * This method return the data of the model
     * @param ManageTemplateRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTemplateRequest $request)
    {
        return Datatables::of($this->template->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('name', function ($template) {
                return $template->name;
            })
             ->addColumn('image', function ($template) {
                // $url= Storage::disk('public')->url('platform/'.$platform->image);
                // return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                return  $template->image;
            })
            ->addColumn('created_at', function ($template) {
                return Carbon::parse($template->created_at)->toDateString();
            })
            ->addColumn('actions', function ($template) {
                return $template->action_buttons;
            })
            ->make(true);
    }
}
