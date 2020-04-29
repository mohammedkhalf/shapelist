@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.orders.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.orders.management') }}</h1>
@endsection

@section('content')

        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.orders.Info') }}</h3>
                </div><!--box-header with-border-->
        </div>

        <table class="table table-striped table-hover">
            <tr>
                <th>{{ trans('labels.backend.orders.table.firstname') }}</th>
                <td>{{ !empty($order->users) ?  $order->users->first_name : '' }}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.lastname') }}</th>
                <td>{{ !empty($order->users) ? $order->users->last_name : '' }}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.email') }}</th>
                <td>{{ !empty($order->users) ? $order->users->email : '' }}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.phone') }}</th>
                <td>
                @if(!empty($order->users))
                  {{ $order->users->phone_number }}
                @else
                    <p>There is No Phone Number</p>
                @endif
                   
                </td>
            </tr>
            <tr>
                <th>{{ trans('labels.backend.orders.table.PackageName') }}</th>
                <td>{{ !empty($order->product) ? $order->product->name : '' }} </td>
            </tr>
            <tr>
                <th>{{ trans('labels.backend.orders.table.platform') }}</th>
                <td>{{ !empty($order->platform) ?  $order->platform->name : '' }} </td> 
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.addon') }}</th>
                <td> {{ !empty($order->addon) ? $order->addon->name : ''  }}</td>
            </tr>

            <tr>
                <th ><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.music') }} <h5></th>
                <td>
                    @if(!empty($order->musicSample))
                    <audio controls style="height:54px;" ><source src='{{Storage::disk('public')->url('smaples/'.$order->musicsample->url)}}' ></audio></td>
                    @else
                        <p style="margin-top:20px;">There is No Music Sample</p>
                    @endif

                    
            </tr>

            <tr>
                <th><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.templateImage') }} </h5></th>
                <td> 
                    @if(!empty($order->template))
                     <img src='{{Storage::disk('public')->url('templates/'. $order->template->image)}}' border="0" width="100" class="img-rounded" align="center" /> 
                    @else
                        <p>There is No Template</p>
                    @endif
                </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.couponCode') }}</th>
                <td>{{ $order->coupon_code }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.productQuantity') }}</th>
                <td>{{ $order->product_quantity }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.totalPrice') }}</th>
                <td>{{ $order->total_price }} SAR </td>
            </tr>
            <tr>
                <th><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.logo') }}</h5></th>
                <td>
                    @if(!empty($order->logo))
                     <img src='{{Storage::disk('public')->url('order_logo/'.$order->logo)}}' border="0" width="50" class="img-rounded" align="center" />
                    @else
                      <p style="margin-top:20px;">There is No logo</p>

                    @endif
                </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.videoLength') }}</th>
                <td> {{ $order->video_length}} minute</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.notes') }}</th>
                <td> {{ $order->notes}}</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.country') }}</th>
                <td>  
                    {{ !empty($order->location) ? $order->location->country : '' }} 
                </td> 
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.city') }}</th>
                <td>  {{ !empty($order->location) ? $order->location->city : '' }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.address') }}</th>
                <td>  {{ !empty($order->location) ? $order->location->address : '' }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.rep_first_name') }}</th>
                <td>  {{ !empty($order->location) ? $order->location->rep_first_name : '' }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.rep_last_name') }}</th>
                <td>  {{ !empty($order->location) ? $order->location->rep_last_name : '' }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.rep_phone_number') }}</th>
                <td>  {{ !empty($order->location) ? $order->location->rep_phone_number : '' }} </td>
            </tr>


            <tr>
                <th> <h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.OrderStatus') }} </h5> </th>
                <td> <h5 class="btn btn-default"> {{ !empty($order->status) ? $order->status->type : '' }}</h5> </td> 
            </tr>
    
            <tr>
                <th><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.paymentStatus') }} </h5> </th>
                <td> 
                     @if($order->payment_status == null)
                        <h4 class="btn btn-danger"> {{ trans('labels.backend.orders.table.NotPay') }} </h4>
                    @else
                    <h4 class="btn btn-success"> {{ trans('labels.backend.orders.table.PayDone') }} </h4>
                    @endif
                     
                 </td>
            </tr>

           

            <tr>
                <th>{{ trans('labels.backend.access.users.tabs.content.overview.created_at') }}</th>
                <td>{{ $order->created_at }} ({{ $order->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.access.users.tabs.content.overview.last_updated') }}</th>
                <td>{{ $order->updated_at }} ({{ $order->updated_at->diffForHumans() }})</td>
            </tr>

           
        </table>
@endsection
