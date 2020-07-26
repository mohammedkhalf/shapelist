@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.products.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.products.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.products.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.products.partials.products-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="products-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.products.table.id') }}</th>
                            <th>{{ trans('labels.backend.products.table.Name') }}</th>
                            <th>{{ trans('labels.backend.products.table.Name_ar') }}</th>
                            <th>{{ trans('labels.backend.products.table.Description') }}</th>
                            <th>{{ trans('labels.backend.products.table.Description_ar') }}</th>
                            <th>{{ trans('labels.backend.products.table.Image') }}</th>
                            <th>{{ trans('labels.backend.products.table.Price') }}</th>
                            {{-- <th>{{ trans('labels.backend.products.table.points') }}</th> --}}
                            <th>{{ trans('labels.backend.products.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>


                        </tr>
                    </thead>
                    <thead class="transparent-bg">

                      @foreach($products  as  $product)
                        <tr>
                            <td> {{$product->id}} </td>
                            <td> {{$product->name}} </td>
                            <td> {{$product->name_ar}} </td>
                            <td> {{$product->description}} </td>
                            <td> {{$product->description_ar}} </td>
                            <td> <img  class="rounded-circle" src="{{ asset('storage/product_images/'.$product->image)}}" width="50"   />

                            </td>
                            <td> {{$product->price}} </td>
                            {{-- <td> {{$product->points}} </td> --}}
                            <td> {{$product->created_at}} </td>
                            <td class="sorting_1">
                                <div class="btn-group action-btn">
                                    <a href="{{route('admin.products.edit' , $product)}}" class="btn btn-flat btn-default">
                                      <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                    </a>

                                    {{-- <a href="{{route('admin.products.destroy' , $product)}}" class="btn btn-flat btn-default" data-method="delete" >
                                      <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                                    </a> --}}
                                    
                                </div>
                            </td>
                        </tr>
                      @endforeach
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
        // $(function() {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
            
        //     var dataTable = $('#products-table').dataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: {
        //             url: '{{ route("admin.products.get") }}',
        //             type: 'post'
        //         },
        //         columns: [
        //             {data: 'id', name: '{{config('module.products.table')}}.id'},
        //             {data: 'name', name: '{{config('module.products.table')}}.name'},
        //             {data: 'description', name: '{{config('module.products.table')}}.description'},
        //             {data: 'image', name: '{{config('module.products.table')}}.image'},
        //             {data: 'price', name: '{{config('module.products.table')}}.price'},
        //             {data: 'created_at', name: '{{config('module.products.table')}}.created_at'},
        //             {data: 'actions', name: 'actions', searchable: false, sortable: false}
        //         ],
        //         order: [[0, "asc"]],
        //         searchDelay: 500,
        //         dom: 'lBfrtip',
        //         buttons: {
        //             buttons: [
        //                 { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1 ]  }},
        //                 { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1 ]  }},
        //                 { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1 ]  }},
        //                 { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1 ]  }},
        //                 { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1 ]  }}
        //             ]
        //         }
        //     });

        //     Backend.DataTableSearch.init(dataTable);
        // });
    </script>
@endsection
