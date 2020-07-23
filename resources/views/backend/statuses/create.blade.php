@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.statuses.management') . ' | ' . trans('labels.backend.statuses.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.statuses.management') }}
        <small>{{ trans('labels.backend.statuses.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.statuses.store', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>true , 'method' => 'post', 'id' => 'create-status']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.statuses.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.statuses.partials.statuses-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
   
                    {{ Form::label('type', trans('labels.backend.statuses.table.type'), ['class' => 'col-lg-2 control-label required']) }} 

                    <div class="col-lg-10">
                       {{ Form::text('type', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.statuses.table.type'), 'required' => 'required']) }} 
                    </div><!--col-lg-10-->
                </div><!--form-group-->

                <div class="form-group">
                    {{ Form::label('type_ar', trans('labels.backend.statuses.table.type_ar'), ['class' => 'col-lg-2 control-label required']) }} 
                        <div class="col-lg-10">
                        {{ Form::text('type_ar', old('type_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.statuses.table.type_ar'), 'required' => 'required']) }} 
                        </div><!--col-lg-10-->
                </div><!--form-group-->
                
                <div class="form-group">
                    {{ Form::label('icon', trans('labels.backend.statuses.table.icon'), ['class' => 'col-lg-2 control-label required']) }} 
                    <div class="col-lg-10">
                        {!! Form::file('icon',array('class'=>'form-control inputfile inputfile-1')) !!} <br/>
                    </div><!--col-lg-10-->
                  
                </div><!--form-group-->
      

                <div class="form-group">
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.statuses.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->

            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
