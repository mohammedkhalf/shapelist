@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.platforms.management') . ' | ' . trans('labels.backend.platforms.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.platforms.management') }}
        <small>{{ trans('labels.backend.platforms.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.platforms.store', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>'true' ,'method' => 'post', 'id' => 'create-platform']) }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.platforms.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.platforms.partials.platforms-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.platforms.name'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.platforms.name'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('image', trans('validation.attributes.backend.platforms.image'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {!! Form::file('image', array('class'=>'form-control inputfile inputfile-1' , 'required' => 'required' )) !!}

                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{-- Including Form blade file --}}
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.platforms.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
