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
                <td>{{  $payment->order_id }}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.status') }}</th>
                <td>
                    @if($payment->status ==1)
                        <p>True</p>
                    @elseif($payment->status ==2)
                        <p>False</p>
                    @endif
                </td>           

            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.bank_transaction_id') }}</th>
                <td>{{ !empty($payment->bank_transaction_id) ? $payment->bank_transaction_id : '' }}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.payments.table.failure_reason') }}</th>
                <td>
                    @if($payment->status ==1)
                        <p></p>
                    @elseif($payment->status ==2)
                        {{$payment->failure_reason }}
                    @endif
                </td>
            </tr>
            
            <tr>
                <th>{{ trans('labels.backend.payments.table.createdat') }}</th>
                <td>{{ $payment->created_at }} ({{ $payment->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.access.users.tabs.content.overview.last_updated') }}</th>
                <td>{{ $payment->updated_at }} ({{ $payment->updated_at->diffForHumans() }})</td>
            </tr>

            @if($payment->deleted_at!=Null)
                    <tr style="color:red">
                        <th> Deleted At</th>
                        <td>{{ $payment->deleted_at }} ({{ $payment->deleted_at->diffForHumans() }})</td>
                    </tr>
            @endif  
        </table>
@endsection
