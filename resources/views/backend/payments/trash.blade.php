@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.payments.trash'))

@section('page-header')
    <h1>{{ trans('labels.backend.payments.trash') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.payments.trash') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.payments.partials.payments-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="payments-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.payments.table.id') }}</th>
                            <th>{{ trans('labels.backend.payments.table.order_id') }}</th>
                            <th>{{ trans('labels.backend.payments.table.status') }}</th>
                            <th>{{ trans('labels.backend.payments.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                        @foreach($trash_payments as $payment)
                            <tr>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->order_id}}</td>
                            <td>{{$payment->status}}</td>
                            <td>{{$payment->created_at}}</td>
                            <td> 
                                <div class="btn-group action-btn">
                                    <button>
                                     <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-eye" data-original-title="veiw"></i>
                                    </button>
                                    <button>
                                    <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-undo" data-original-title="restore"></i>
                                    </button>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection 



