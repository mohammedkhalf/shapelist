<?php

namespace App\Http\Controllers\Backend\Quotation;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Quotation\QuotationRepository;
use App\Http\Requests\Backend\Quotation\ManageQuotationRequest;

/**
 * Class QuotationsTableController.
 */
class QuotationsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var QuotationRepository
     */
    protected $quotation;

    /**
     * contructor to initialize repository object
     * @param QuotationRepository $quotation;
     */
    public function __construct(QuotationRepository $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * This method return the data of the model
     * @param ManageQuotationRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageQuotationRequest $request)
    {
        return Datatables::of($this->quotation->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($quotation) {
                return Carbon::parse($quotation->created_at)->toDateString();
            })
            ->addColumn('actions', function ($quotation) {
                return $quotation->action_buttons;
            })
            ->make(true);
    }
}
