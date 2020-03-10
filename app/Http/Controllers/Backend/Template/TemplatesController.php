<?php

namespace App\Http\Controllers\Backend\Template;

use App\Models\Template\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Template\CreateResponse;
use App\Http\Responses\Backend\Template\EditResponse;
use App\Repositories\Backend\Template\TemplateRepository;
use App\Http\Requests\Backend\Template\ManageTemplateRequest;
use App\Http\Requests\Backend\Template\CreateTemplateRequest;
use App\Http\Requests\Backend\Template\StoreTemplateRequest;
use App\Http\Requests\Backend\Template\EditTemplateRequest;
use App\Http\Requests\Backend\Template\UpdateTemplateRequest;
use App\Http\Requests\Backend\Template\DeleteTemplateRequest;

/**
 * TemplatesController
 */
class TemplatesController extends Controller
{
    /**
     * variable to store the repository object
     * @var TemplateRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param TemplateRepository $repository;
     */
    public function __construct(TemplateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Template\ManageTemplateRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTemplateRequest $request)
    {
        return new ViewResponse('backend.templates.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateTemplateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Template\CreateResponse
     */
    public function create(CreateTemplateRequest $request)
    {
        return new CreateResponse('backend.templates.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTemplateRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreTemplateRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.templates.index'), ['flash_success' => trans('alerts.backend.templates.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Template\Template  $template
     * @param  EditTemplateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Template\EditResponse
     */
    public function edit(Template $template, EditTemplateRequest $request)
    {
        return new EditResponse($template);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTemplateRequestNamespace  $request
     * @param  App\Models\Template\Template  $template
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateTemplateRequest $request, Template $template)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $template, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.templates.index'), ['flash_success' => trans('alerts.backend.templates.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteTemplateRequestNamespace  $request
     * @param  App\Models\Template\Template  $template
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Template $template, DeleteTemplateRequest $request)
    {
        $image_path = public_path() .  '/storage/templates/' . $template->image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        //Calling the delete method on repository
        $this->repository->delete($template);
        //returning with successfull message
        return new RedirectResponse(route('admin.templates.index'), ['flash_success' => trans('alerts.backend.templates.deleted')]);
    }
    
}
