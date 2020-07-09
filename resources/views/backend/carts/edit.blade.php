@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.carts.management') . ' | ' . trans('labels.backend.carts.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.carts.management') }}
        <small>{{ trans('labels.backend.carts.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($carts, ['route' => ['admin.carts.update', $cart], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-cart']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.carts.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.carts.partials.carts-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.carts.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.carts.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
