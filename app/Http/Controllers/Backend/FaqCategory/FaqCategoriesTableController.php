<?php

namespace App\Http\Controllers\Backend\FaqCategory;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\FaqCategory\FaqCategoryRepository;
use App\Http\Requests\Backend\FaqCategory\ManageFaqCategoryRequest;

/**
 * Class FaqCategoriesTableController.
 */
class FaqCategoriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var FaqCategoryRepository
     */
    protected $faqcategory;

    /**
     * contructor to initialize repository object
     * @param FaqCategoryRepository $faqcategory;
     */
    public function __construct(FaqCategoryRepository $faqcategory)
    {
        $this->faqcategory = $faqcategory;
    }

    /**
     * This method return the data of the model
     * @param ManageFaqCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageFaqCategoryRequest $request)
    {
        return Datatables::of($this->faqcategory->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($faqcategory) {
                return Carbon::parse($faqcategory->created_at)->toDateString();
            })
            ->addColumn('actions', function ($faqcategory) {
                return $faqcategory->action_buttons;
            })
            ->make(true);
    }
}
