<?php

namespace App\Http\Controllers\Backend\Platform;

use App\Models\Platform\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Platform\CreateResponse;
use App\Http\Responses\Backend\Platform\EditResponse;
use App\Repositories\Backend\Platform\PlatformRepository;
use App\Http\Requests\Backend\Platform\ManagePlatformRequest;
use App\Http\Requests\Backend\Platform\CreatePlatformRequest;
use App\Http\Requests\Backend\Platform\StorePlatformRequest;
use App\Http\Requests\Backend\Platform\EditPlatformRequest;
use App\Http\Requests\Backend\Platform\UpdatePlatformRequest;
use App\Http\Requests\Backend\Platform\DeletePlatformRequest;

/**
 * PlatformsController
 */
class PlatformsController extends Controller
{
    /**
     * variable to store the repository object
     * @var PlatformRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param PlatformRepository $repository;
     */
    public function __construct(PlatformRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Platform\ManagePlatformRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePlatformRequest $request)
    {
        return new ViewResponse('backend.platforms.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreatePlatformRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Platform\CreateResponse
     */
    public function create(CreatePlatformRequest $request)
    {
        return new CreateResponse('backend.platforms.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePlatformRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePlatformRequest $request)
    {
        // dd($request->all());
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.platforms.index'), ['flash_success' => trans('alerts.backend.platforms.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Platform\Platform  $platform
     * @param  EditPlatformRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Platform\EditResponse
     */
    public function edit(Platform $platform, EditPlatformRequest $request)
    {
        return view('backend.platforms.edit', compact('platform'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePlatformRequestNamespace  $request
     * @param  App\Models\Platform\Platform  $platform
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        
        //Input received from the request
        $input = $request->except(['_token','_method']);
        //Update the model using repository update method
        $this->repository->update( $platform, $input);
        //return with successfull message
        return new RedirectResponse(route('admin.platforms.index'), ['flash_success' => trans('alerts.backend.platforms.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePlatformRequestNamespace  $request
     * @param  App\Models\Platform\Platform  $platform
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Platform $platform, DeletePlatformRequest $request)
    {
        $image_path = public_path() .  '/storage/platform/' . $platform->image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        //Calling the delete method on repository
        $this->repository->delete($platform);
        //returning with successfull message
        return new RedirectResponse(route('admin.platforms.index'), ['flash_success' => trans('alerts.backend.platforms.deleted')]);
    }
    
}
