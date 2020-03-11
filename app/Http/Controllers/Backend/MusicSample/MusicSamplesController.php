<?php

namespace App\Http\Controllers\Backend\MusicSample;

use App\Models\MusicSample\MusicSample;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\MusicSample\CreateResponse;
use App\Http\Responses\Backend\MusicSample\EditResponse;
use App\Repositories\Backend\MusicSample\MusicSampleRepository;
use App\Http\Requests\Backend\MusicSample\ManageMusicSampleRequest;
use App\Http\Requests\Backend\MusicSample\CreateMusicSampleRequest;
use App\Http\Requests\Backend\MusicSample\StoreMusicSampleRequest;
use App\Http\Requests\Backend\MusicSample\EditMusicSampleRequest;
use App\Http\Requests\Backend\MusicSample\UpdateMusicSampleRequest;
use App\Http\Requests\Backend\MusicSample\DeleteMusicSampleRequest;

/**
 * MusicSamplesController
 */
class MusicSamplesController extends Controller
{
    /**
     * variable to store the repository object
     * @var MusicSampleRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param MusicSampleRepository $repository;
     */
    public function __construct(MusicSampleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\MusicSample\ManageMusicSampleRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageMusicSampleRequest $request)
    {
        return new ViewResponse('backend.musicsamples.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateMusicSampleRequestNamespace  $request
     * @return \App\Http\Responses\Backend\MusicSample\CreateResponse
     */
    public function create(CreateMusicSampleRequest $request)
    {
        return new CreateResponse('backend.musicsamples.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMusicSampleRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreMusicSampleRequest $request)
    {
        // dd($request->all()); 
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.musicsamples.index'), ['flash_success' => trans('alerts.backend.musicsamples.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\MusicSample\MusicSample  $musicsample
     * @param  EditMusicSampleRequestNamespace  $request
     * @return \App\Http\Responses\Backend\MusicSample\EditResponse
     */
    public function edit(MusicSample $musicsample, EditMusicSampleRequest $request)
    {
        return new EditResponse($musicsample);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateMusicSampleRequestNamespace  $request
     * @param  App\Models\MusicSample\MusicSample  $musicsample
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateMusicSampleRequest $request, MusicSample $musicsample)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $musicsample, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.musicsamples.index'), ['flash_success' => trans('alerts.backend.musicsamples.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteMusicSampleRequestNamespace  $request
     * @param  App\Models\MusicSample\MusicSample  $musicsample
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(MusicSample $musicsample, DeleteMusicSampleRequest $request)
    {
        $music_path = public_path() .  '/storage/smaples/' . $musicsample->url;
        if (file_exists($music_path)) {
            @unlink($music_path);
        }
        //Calling the delete method on repository
        $this->repository->delete($musicsample);
        //returning with successfull message
        return new RedirectResponse(route('admin.musicsamples.index'), ['flash_success' => trans('alerts.backend.musicsamples.deleted')]);
    }
    
}
