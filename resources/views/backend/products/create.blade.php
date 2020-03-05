@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.products.management') . ' | ' . trans('labels.backend.products.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.products.management') }}
        <small>{{ trans('labels.backend.products.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true , 'id' => 'create-product']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.products.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.products.partials.products-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.products.product-name'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.products.product-name'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('description', trans('validation.attributes.backend.products.description'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null,['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.products.description')]) }}
                    </div><!--col-lg-3-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('image', trans('validation.attributes.backend.products.image'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">

                        {!! Form::file('image', array('class'=>'form-control inputfile inputfile-1' , 'required' => 'required' )) !!}

                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('price', trans('validation.attributes.backend.products.price'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('price', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.products.price'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                <div class="form-group">
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.products.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
