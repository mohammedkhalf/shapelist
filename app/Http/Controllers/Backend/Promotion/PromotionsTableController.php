<?php

namespace App\Http\Controllers\Backend\Promotion;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Promotion\PromotionRepository;
use App\Http\Requests\Backend\Promotion\ManagePromotionRequest;

/**
 * Class PromotionsTableController.
 */
class PromotionsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var PromotionRepository
     */
    protected $promotion;

    /**
     * contructor to initialize repository object
     * @param PromotionRepository $promotion;
     */
    public function __construct(PromotionRepository $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * This method return the data of the model
     * @param ManagePromotionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePromotionRequest $request)
    {
        return Datatables::of($this->promotion->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($promotion) {
                return Carbon::parse($promotion->created_at)->toDateString();
            })
            ->addColumn('actions', function ($promotion) {
                return $promotion->action_buttons;
            })
            ->make(true);
    }
}
