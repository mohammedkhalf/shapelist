@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.payments.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.payments.management') }}</h1>
@endsection

@section('content')

        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.payments.Info') }}</h3>
                </div><!--box-header with-border-->
        </div>

        <table class="table table-striped table-hover">
            <tr>
                <th>{{ trans('labels.backend.payments.table.order_id') }}</th>
                {{-- <td>{{ !empty($payment->users) ?  $order->users->first_name : '' }}</td> --}}
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.status') }}</th>
                {{-- <td>{{ !empty($order->users) ? $order->users->last_name : '' }}</td> --}}
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.bank_transaction_id') }}</th>
                {{-- <td>{{ !empty($order->users) ? $order->users->email : '' }}</td> --}}
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.failure_reason') }}</th>
                {{-- <td>
                @if(!empty($order->users))
                  {{ $order->users->phone_number }}
                @else
                    <p>There is No Phone Number</p>
                @endif
                   
                </td> --}}
            </tr>
            
            <tr>
                <th>{{ trans('labels.backend.payments.table.createdat') }}</th>
                {{-- <td>{{ $order->created_at }} ({{ $order->created_at->diffForHumans() }})</td> --}}
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.last_updated') }}</th>
                {{-- <td>{{ $order->updated_at }} ({{ $order->updated_at->diffForHumans() }})</td> --}}
            </tr>

           
        </table>
@endsection
