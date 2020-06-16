<?php

namespace App\Http\Controllers\Backend\Package;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Package\PackageRepository;
use App\Http\Requests\Backend\Package\ManagePackageRequest;

/**
 * Class PackagesTableController.
 */
class PackagesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var PackageRepository
     */
    protected $package;

    /**
     * contructor to initialize repository object
     * @param PackageRepository $package;
     */
    public function __construct(PackageRepository $package)
    {
        $this->package = $package;
    }

    /**
     * This method return the data of the model
     * @param ManagePackageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePackageRequest $request)
    {
        return Datatables::of($this->package->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('name_ar', function ($package) {
                return $package->name_ar;
            })
            ->addColumn('name_en', function ($package) {
                return $package->name_en;
            })
            ->addColumn('price', function ($package) {
                return $package->price;
            })
            ->addColumn('desc_ar', function ($package) {
                return $package->desc_ar;
            })
            ->addColumn('desc_en', function ($package) {
                return $package->desc_en;
            })
            ->addColumn('created_at', function ($package) {
                return Carbon::parse($package->created_at)->toDateString();
            })
            ->addColumn('actions', function ($package) {
                return $package->action_buttons;
            })
            ->make(true);
    }
}
