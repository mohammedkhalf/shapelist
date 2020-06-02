<?php

namespace App\Repositories\Backend\Payment;

use DB;
use Carbon\Carbon;
use App\Models\Payment\Payment;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentRepository.
 */
class PaymentRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Payment::class;

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
                config('module.payments.table').'.id',

                config('module.payments.table').'.id',
                config('module.payments.table').'.status',
                config('module.payments.table').'.order_id',
                config('module.payments.table').'.bank_transaction_id',
                config('module.payments.table').'.failure_reason',
                config('module.payments.table').'.created_at',
                config('module.payments.table').'.updated_at',
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
        if (Payment::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.payments.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Payment $payment
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Payment $payment, array $input)
    {
    	if ($payment->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.payments.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Payment $payment
     * @throws GeneralException
     * @return bool
     */
    public function delete(Payment $payment)
    {
        if ($payment->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.payments.delete_error'));
    }
}
