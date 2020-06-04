<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Payment\CreateResponse;
use App\Http\Responses\Backend\Payment\EditResponse;
use App\Repositories\Backend\Payment\PaymentRepository;
use App\Http\Requests\Backend\Payment\ManagePaymentRequest;
use App\Http\Requests\Backend\Payment\CreatePaymentRequest;
use App\Http\Requests\Backend\Payment\StorePaymentRequest;
use App\Http\Requests\Backend\Payment\EditPaymentRequest;
use App\Http\Requests\Backend\Payment\UpdatePaymentRequest;
use App\Http\Requests\Backend\Payment\DeletePaymentRequest;
use App\Http\Requests\Backend\Payment\ViewPaymentRequest; 
use DB;
/**
 * PaymentsController
 */
class PaymentsController extends Controller
{
    /**
     * variable to store the repository object
     * @var PaymentRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param PaymentRepository $repository;
     */
    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Payment\ManagePaymentRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePaymentRequest $request)
    {
        return new ViewResponse('backend.payments.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreatePaymentRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Payment\CreateResponse
     */
    public function create(CreatePaymentRequest $request)
    {
        return new CreateResponse('backend.payments.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePaymentRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.payments.index'), ['flash_success' => trans('alerts.backend.payments.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Payment\Payment  $payment
     * @param  EditPaymentRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Payment\EditResponse
     */
    public function edit(Payment $payment, EditPaymentRequest $request)
    {
        return new EditResponse($payment);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentRequestNamespace  $request
     * @param  App\Models\Payment\Payment  $payment
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $payment, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.payments.index'), ['flash_success' => trans('alerts.backend.payments.updated')]);
    }
    public function show(ViewPaymentRequest $request , Payment $payment)
    {
        if(is_null($payment))
        {
            return back();
        }  

        return new ViewResponse('backend.payments.view', compact('payment'));
    }
    public function trash(){

        $trash_payments = Payment::withTrashed()->whereNotNull('deleted_at')->get(); 
        return new ViewResponse('backend.payments.trash',compact('trash_payments'));
    }

    public function viewTrash($id)
    {
        
        $payment = Payment::withTrashed()->where('id',$id)->first(); 
         return new ViewResponse('backend.payments.view', compact('payment'));
    }

    public function restore($id){

        $trash_item = Payment::withTrashed()->where('id',$id)->first();; 
        $trash_item->deleted_at = Null;
        $trash_item->save();
        return new RedirectResponse(route('admin.payments.index'), ['flash_success' => 'this record is restored successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePaymentRequestNamespace  $request
     * @param  App\Models\Payment\Payment  $payment
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Payment $payment, DeletePaymentRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($payment);
        //returning with successfull message
        return new RedirectResponse(route('admin.payments.index'), ['flash_success' => trans('alerts.backend.payments.deleted')]);
    }
    
}
