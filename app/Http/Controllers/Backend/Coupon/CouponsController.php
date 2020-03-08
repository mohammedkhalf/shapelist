<?php

namespace App\Http\Controllers\Backend\Coupon;

use App\Models\Coupon\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Coupon\CreateResponse;
use App\Http\Responses\Backend\Coupon\EditResponse;
use App\Repositories\Backend\Coupon\CouponRepository;
use App\Http\Requests\Backend\Coupon\ManageCouponRequest;
use App\Http\Requests\Backend\Coupon\CreateCouponRequest;
use App\Http\Requests\Backend\Coupon\StoreCouponRequest;
use App\Http\Requests\Backend\Coupon\EditCouponRequest;
use App\Http\Requests\Backend\Coupon\UpdateCouponRequest;
use App\Http\Requests\Backend\Coupon\DeleteCouponRequest;

/**
 * CouponsController
 */
class CouponsController extends Controller
{
    /**
     * variable to store the repository object
     * @var CouponRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param CouponRepository $repository;
     */
    public function __construct(CouponRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Coupon\ManageCouponRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCouponRequest $request)
    {
        return new ViewResponse('backend.coupons.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateCouponRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Coupon\CreateResponse
     */
    public function create(CreateCouponRequest $request)
    {
        return new CreateResponse('backend.coupons.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCouponRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreCouponRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.coupons.index'), ['flash_success' => trans('alerts.backend.coupons.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Coupon\Coupon  $coupon
     * @param  EditCouponRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Coupon\EditResponse
     */
    public function edit(Coupon $coupon, EditCouponRequest $request)
    {
        return new EditResponse($coupon);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCouponRequestNamespace  $request
     * @param  App\Models\Coupon\Coupon  $coupon
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $coupon, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.coupons.index'), ['flash_success' => trans('alerts.backend.coupons.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCouponRequestNamespace  $request
     * @param  App\Models\Coupon\Coupon  $coupon
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Coupon $coupon, DeleteCouponRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($coupon);
        //returning with successfull message
        return new RedirectResponse(route('admin.coupons.index'), ['flash_success' => trans('alerts.backend.coupons.deleted')]);
    }
    
}
