@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.subscriptions.management'))

@section('page-header')
<h1>{{ trans('labels.backend.subscriptions.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            {{-- <h1>{{ trans('labels.backend.subscriptions.management') }}</h1> --}}

            <div class="box-tools pull-right">
                @include('backend.payments.partials.payments-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="payments-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.subscriptions.table.id')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.user_id')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.name')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.email')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.phone')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.purchase_points')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.free_points')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.start_date')  }}</th>
                            <th>{{ trans('labels.backend.subscriptions.table.end_date')  }} </th>
                            <th>{{ trans('labels.backend.subscriptions.table.status')  }} </th>

                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                        @foreach($subscriber as $subscribInfo)
                        
                            @foreach($subscribInfo->subscription  as $subInfo)
                                    
                                
                                    <tr>
                                        <td>{{$subInfo->pivot->user_id}}</td>
                                        <td>{{$subInfo->id}}</td>
                                        <td>{{$subInfo->first_name}} {{$subInfo->last_name}}</td>
                                        <td>{{$subInfo->email}}</td>
                                        <td>{{$subInfo->phone_number}}</td>
                                        <td>{{$subInfo->pivot->purchase_points}}</td>
                                        <td>{{$subInfo->pivot->free_points}}</td>
                                        <td>{{$subInfo->pivot->start_date}}</td>
                                        <td>{{$subInfo->pivot->end_date}}</td>
                                        @if($subInfo->pivot->status== 0 )
                                            <td style="color:red"><b>Inactive</b></td>
                                            <td> 
                                                    <div class="btn-group action-btn">
                                                    <a  class="btn btn-default" href="{{ route('admin.restore', $subscribInfo->id ) }}">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="delete"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        @endif
                                        @if($subInfo->pivot->status== 1)
                                            <td style="color:green"><b>Active</b></td>
                                            <td> --- </td>
                                        @endif
                                    </tr>
                            @endforeach
                        @endforeach      
                        {{-- @if (count($subscribInfo)< 1) 
                            <tbody>
                                <tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>
                            </tbody>
                        @endif --}}
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection 



