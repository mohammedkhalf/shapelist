<?php

namespace App\Http\Controllers\Backend\Package;

use App\Models\Package\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Package\CreateResponse;
use App\Http\Responses\Backend\Package\EditResponse;
use App\Repositories\Backend\Package\PackageRepository;
use App\Http\Requests\Backend\Package\ManagePackageRequest;
use App\Http\Requests\Backend\Package\CreatePackageRequest;
use App\Http\Requests\Backend\Package\StorePackageRequest;
use App\Http\Requests\Backend\Package\EditPackageRequest;
use App\Http\Requests\Backend\Package\UpdatePackageRequest;
use App\Http\Requests\Backend\Package\DeletePackageRequest;

/**
 * PackagesController
 */
class PackagesController extends Controller
{
    /**
     * variable to store the repository object
     * @var PackageRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param PackageRepository $repository;
     */
    public function __construct(PackageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Package\ManagePackageRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePackageRequest $request)
    {
        return new ViewResponse('backend.packages.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreatePackageRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Package\CreateResponse
     */
    public function create(CreatePackageRequest $request)
    {
        return new CreateResponse('backend.packages.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePackageRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePackageRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.packages.index'), ['flash_success' => trans('alerts.backend.packages.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Package\Package  $package
     * @param  EditPackageRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Package\EditResponse
     */
    public function edit(Package $package, EditPackageRequest $request)
    {
        return new EditResponse($package);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePackageRequestNamespace  $request
     * @param  App\Models\Package\Package  $package
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $package, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.packages.index'), ['flash_success' => trans('alerts.backend.packages.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePackageRequestNamespace  $request
     * @param  App\Models\Package\Package  $package
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Package $package, DeletePackageRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($package);
        //returning with successfull message
        return new RedirectResponse(route('admin.packages.index'), ['flash_success' => trans('alerts.backend.packages.deleted')]);
    }
    
}
