@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.payments.management') . ' | ' . trans('labels.backend.payments.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.payments.management') }}
        <small>{{ trans('labels.backend.payments.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($payments, ['route' => ['admin.payments.update', $payment], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-payment']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.payments.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.payments.partials.payments-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.payments.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.payments.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
