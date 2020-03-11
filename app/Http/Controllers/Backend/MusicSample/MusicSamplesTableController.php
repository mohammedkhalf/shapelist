<?php

namespace App\Http\Controllers\Backend\MusicSample;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\MusicSample\MusicSampleRepository;
use App\Http\Requests\Backend\MusicSample\ManageMusicSampleRequest;
use Storage;

/**
 * Class MusicSamplesTableController.
 */
class MusicSamplesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var MusicSampleRepository
     */
    protected $musicsample;

    /**
     * contructor to initialize repository object
     * @param MusicSampleRepository $musicsample;
     */
    public function __construct(MusicSampleRepository $musicsample)
    {
        $this->musicsample = $musicsample;
    }

    /**
     * This method return the data of the model
     * @param ManageMusicSampleRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMusicSampleRequest $request)
    {
        return Datatables::of($this->musicsample->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('name', function ($musicsample) {
                return $musicsample->name;
            })
            ->addColumn('type', function ($musicsample) {
                return $musicsample->type;
            })
            ->addColumn('url', function ($musicsample) {

                $url=Storage::disk('public')->url('samples/'.$musicsample->url);

                return '<audio controls style="height:54px;" ><source src='.$url.' ></audio>
                ';
            })
            ->addColumn('created_at', function ($musicsample) {
                return Carbon::parse($musicsample->created_at)->toDateString();
            })
            ->addColumn('actions', function ($musicsample) {
                return $musicsample->action_buttons;
            })
            ->make(true);
    }
}
