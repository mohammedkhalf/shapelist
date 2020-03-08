<?php

namespace App\Http\Controllers\Backend\Addon;

use App\Models\Addon\Addon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Addon\CreateResponse;
use App\Http\Responses\Backend\Addon\EditResponse;
use App\Repositories\Backend\Addon\AddonRepository;
use App\Http\Requests\Backend\Addon\ManageAddonRequest;
use App\Http\Requests\Backend\Addon\CreateAddonRequest;
use App\Http\Requests\Backend\Addon\StoreAddonRequest;
use App\Http\Requests\Backend\Addon\EditAddonRequest;
use App\Http\Requests\Backend\Addon\UpdateAddonRequest;
use App\Http\Requests\Backend\Addon\DeleteAddonRequest;

/**
 * AddonsController
 */
class AddonsController extends Controller
{
    /**
     * variable to store the repository object
     * @var AddonRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param AddonRepository $repository;
     */
    public function __construct(AddonRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Addon\ManageAddonRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageAddonRequest $request)
    {
        return new ViewResponse('backend.addons.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateAddonRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Addon\CreateResponse
     */
    public function create(CreateAddonRequest $request)
    {
        return new CreateResponse('backend.addons.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAddonRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreAddonRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.addons.index'), ['flash_success' => trans('alerts.backend.addons.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Addon\Addon  $addon
     * @param  EditAddonRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Addon\EditResponse
     */
    public function edit(Addon $addon, EditAddonRequest $request)
    {
        return new EditResponse($addon);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAddonRequestNamespace  $request
     * @param  App\Models\Addon\Addon  $addon
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateAddonRequest $request, Addon $addon)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $addon, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.addons.index'), ['flash_success' => trans('alerts.backend.addons.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteAddonRequestNamespace  $request
     * @param  App\Models\Addon\Addon  $addon
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Addon $addon, DeleteAddonRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($addon);
        //returning with successfull message
        return new RedirectResponse(route('admin.addons.index'), ['flash_success' => trans('alerts.backend.addons.deleted')]);
    }
    
}
