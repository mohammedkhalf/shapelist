@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.promotions.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.promotions.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.promotions.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.orders.partials.orders-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="orders-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.orders.table.order_id') }}</th>
                            <th>{{ trans('labels.backend.orders.table.name_ar') }}</th>
                            <th>{{ trans('labels.backend.orders.table.name_en') }}</th>
                            <th>{{ trans('labels.backend.orders.table.desc_ar') }}</th>
                            <th>{{ trans('labels.backend.orders.table.desc_en') }}</th>
                            <th>{{ trans('labels.backend.orders.table.promotion_price') }}</th>
                          
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        @foreach($promotions  as $prObj)
                        <tr>
                            <td>{{$prObj->order_id}}</td>
                            <td>{{$prObj->name_ar}}</td>
                            <td>{{$prObj->name_en}}</td>
                            <td>{{$prObj->desc_ar}}</td>
                            <td>{{$prObj->desc_en}}</td>
                            <td>{{$prObj->promotion_price}}</td>

                        </tr>
                        @endforeach
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection
