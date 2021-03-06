<?php

namespace App\Http\Controllers\Backend\Platform;
use Storage;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Platform\PlatformRepository;
use App\Http\Requests\Backend\Platform\ManagePlatformRequest;

/**
 * Class PlatformsTableController.
 */
class PlatformsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var PlatformRepository
     */
    protected $platform;

    /**
     * contructor to initialize repository object
     * @param PlatformRepository $platform;
     */
    public function __construct(PlatformRepository $platform)
    {
        $this->platform = $platform;
    }

    /**
     * This method return the data of the model
     * @param ManagePlatformRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePlatformRequest $request)
    {

        return Datatables::of($this->platform->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('name', function ($platform) {
                return $platform->name;
            })
            ->addColumn('image', function ($platform) {
                // return $platform->image;
                $url= Storage::disk('public')->url('platform/'.$platform->image);
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('created_at', function ($platform) {
                return Carbon::parse($platform->created_at);
            })
            ->addColumn('actions', function ($platform) {
                return $platform->action_buttons;
            })
            ->make(true);
    }
}
