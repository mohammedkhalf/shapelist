<?php

namespace App\Http\Controllers\Backend\Cart;

use App\Models\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Cart\CreateResponse;
use App\Http\Responses\Backend\Cart\EditResponse;
use App\Repositories\Backend\Cart\CartRepository;
use App\Http\Requests\Backend\Cart\ManageCartRequest;
use App\Http\Requests\Backend\Cart\CreateCartRequest;
use App\Http\Requests\Backend\Cart\StoreCartRequest;
use App\Http\Requests\Backend\Cart\EditCartRequest;
use App\Http\Requests\Backend\Cart\UpdateCartRequest;
use App\Http\Requests\Backend\Cart\DeleteCartRequest;

/**
 * CartsController
 */
class CartsController extends Controller
{
    /**
     * variable to store the repository object
     * @var CartRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param CartRepository $repository;
     */
    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Cart\ManageCartRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCartRequest $request)
    {
        return new ViewResponse('backend.carts.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateCartRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Cart\CreateResponse
     */
    public function create(CreateCartRequest $request)
    {
        return new CreateResponse('backend.carts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCartRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreCartRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.carts.index'), ['flash_success' => trans('alerts.backend.carts.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Cart\Cart  $cart
     * @param  EditCartRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Cart\EditResponse
     */
    public function edit(Cart $cart, EditCartRequest $request)
    {
        return new EditResponse($cart);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCartRequestNamespace  $request
     * @param  App\Models\Cart\Cart  $cart
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $cart, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.carts.index'), ['flash_success' => trans('alerts.backend.carts.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCartRequestNamespace  $request
     * @param  App\Models\Cart\Cart  $cart
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Cart $cart, DeleteCartRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($cart);
        //returning with successfull message
        return new RedirectResponse(route('admin.carts.index'), ['flash_success' => trans('alerts.backend.carts.deleted')]);
    }
    
}
