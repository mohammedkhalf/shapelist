@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.templates.management') . ' | ' . trans('labels.backend.templates.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.templates.management') }}
        <small>{{ trans('labels.backend.templates.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.templates.store', 'class' => 'form-horizontal', 'files'=>'true' ,  'role' => 'form', 'method' => 'post', 'id' => 'create-template']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.templates.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.templates.partials.templates-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">

                <div class="form-group">
                    {{ Form::label('name', trans('labels.backend.templates.table.name'), ['class' => 'col-lg-2 control-label required']) }} 
                    <div class="col-lg-10">
                    {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.templates.table.name'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form-group-->

                <div class="form-group">

                    {{ Form::label('image', trans('labels.backend.templates.table.image'), ['class' => 'col-lg-2 control-label required']) }} 
                    <div class="col-lg-10">
                        {!! Form::file('image',array('class'=>'form-control inputfile inputfile-1' , 'required' => 'required')) !!} <br/>

                    </div><!--col-lg-10-->
                </div><!--form-group-->
                
                <div class="form-group">
                    
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.templates.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
