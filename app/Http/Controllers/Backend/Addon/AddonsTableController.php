<?php

namespace App\Http\Controllers\Backend\Addon;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Addon\AddonRepository;
use App\Http\Requests\Backend\Addon\ManageAddonRequest;

/**
 * Class AddonsTableController.
 */
class AddonsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var AddonRepository
     */
    protected $addon;

    /**
     * contructor to initialize repository object
     * @param AddonRepository $addon;
     */
    public function __construct(AddonRepository $addon)
    {
        $this->addon = $addon;
    }

    /**
     * This method return the data of the model
     * @param ManageAddonRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageAddonRequest $request)
    {
        return Datatables::of($this->addon->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('name_en', function ($addon) {
                return $addon->name_en;
            })
            ->addColumn('name_ar', function ($addon) {
                return $addon->name_ar;
            })
            ->addColumn('description_en', function ($addon) {
                return $addon->description_en;
            })
            ->addColumn('description_ar', function ($addon) {
                return $addon->description_ar;
            })
            ->addColumn('price', function ($addon) {
                return $addon->price;
            })
            ->addColumn('created_at', function ($addon) {
                return Carbon::parse($addon->created_at)->toDateString();
            })
            ->addColumn('actions', function ($addon) {
                return $addon->action_buttons;
            })
            ->make(true);
    }
}
