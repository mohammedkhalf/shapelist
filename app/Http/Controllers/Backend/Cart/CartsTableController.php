<?php

namespace App\Http\Controllers\Backend\Cart;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Cart\CartRepository;
use App\Http\Requests\Backend\Cart\ManageCartRequest;

/**
 * Class CartsTableController.
 */
class CartsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var CartRepository
     */
    protected $cart;

    /**
     * contructor to initialize repository object
     * @param CartRepository $cart;
     */
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * This method return the data of the model
     * @param ManageCartRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCartRequest $request)
    {
        return Datatables::of($this->cart->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($cart) {
                return Carbon::parse($cart->created_at)->toDateString();
            })
            ->addColumn('actions', function ($cart) {
                return $cart->action_buttons;
            })
            ->make(true);
    }
}
