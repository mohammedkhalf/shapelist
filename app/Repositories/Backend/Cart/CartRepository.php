<?php

namespace App\Repositories\Backend\Cart;

use DB;
use Carbon\Carbon;
use App\Models\Cart\Cart;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartRepository.
 */
class CartRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Cart::class;

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
                config('module.carts.table').'.id',
                config('module.carts.table').'.created_at',
                config('module.carts.table').'.updated_at',
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
        if (Cart::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.carts.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Cart $cart
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Cart $cart, array $input)
    {
    	if ($cart->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.carts.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Cart $cart
     * @throws GeneralException
     * @return bool
     */
    public function delete(Cart $cart)
    {
        if ($cart->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.carts.delete_error'));
    }
}
