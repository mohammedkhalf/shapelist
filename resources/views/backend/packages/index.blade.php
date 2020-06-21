@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.packages.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.packages.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.packages.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.packages.partials.packages-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="packages-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.packages.table.id') }}</th>
                            <th>{{ trans('labels.backend.packages.table.name_ar') }}</th>
                            <th>{{ trans('labels.backend.packages.table.name_en') }}</th>
                            <th>{{ trans('labels.backend.packages.table.product') }}</th>
                            <th>{{ trans('labels.backend.packages.table.quantity') }}</th>
                            <th>{{ trans('labels.backend.packages.table.price') }}</th>
                            <th>{{ trans('labels.backend.packages.table.desc_ar') }}</th>
                            <th>{{ trans('labels.backend.packages.table.desc_en') }}</th>
                            <th>{{ trans('labels.backend.packages.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        //Below written line is short form of writing $(document).ready(function() { })
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var dataTable = $('#packages-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.packages.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.packages.table')}}.id'},
                    {data: 'name_ar', name: '{{config('module.packages.table')}}.name_ar'},
                    {data: 'name_en', name: '{{config('module.packages.table')}}.name_en'},
                    {data: 'product_id', name: '{{config('module.packages.table')}}.product_id'},
                    {data: 'quantity', name: '{{config('module.packages.table')}}.quantity'},
                    {data: 'price', name: '{{config('module.packages.table')}}.price'},
                    {data: 'desc_ar', name: '{{config('module.packages.table')}}.desc_ar'},
                    {data: 'desc_en', name: '{{config('module.packages.table')}}.desc_en'},
                    {data: 'created_at', name: '{{config('module.packages.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
