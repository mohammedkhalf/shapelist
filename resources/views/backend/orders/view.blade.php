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
                <th>{{ trans('labels.backend.orders.table.totalPrice') }}</th>
                <td>{{ $order->total_price }} SAR </td>
            </tr>
              
            <tr>
                <th> <h5>{{ trans('labels.backend.orders.table.deliver_id') }} </h5> </th>
                <td> 
                    @if($order->delivery_id == 1)  
                        <button class="btn btn-success"> Express </button>
                    @elseif($order->delivery_id == 2)
                        <button class="btn btn-success"> Fast </button>
                    @else
                        <button class="btn btn-success"> Standard </button>
                    @endif
                </td>
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
                <th>{{ trans('labels.backend.orders.table.onSet') }}</th>
                <td>{{ $order->on_set }} </td>
            </tr>
            
            <tr>
                <th>{{ trans('labels.backend.orders.table.couponCode') }}</th>
                <td>{{ $order->coupon_code }} </td>
            </tr>

            <tr>
                <th>{{ trans('labels.backend.orders.table.NumOfProducts') }}</th>
                <td> {{$numProducts}} </td>
            </tr>

            @foreach($photoProduct as $photo)
                <tr>
                    <th>{{ trans('labels.backend.orders.table.FirstProduct') }}</th>
                    <td> {{ App\Models\Product\Product::where('id','=',$photo->product_id)->pluck('name')->first() }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.orders.table.quantity') }} (photo)</th>
                    <td> {{ $photo->product_quantity }} </td>
                </tr>
            @endforeach

            @foreach($vedioProduct as $vedio)
                <tr>
                    <th>{{ trans('labels.backend.orders.table.SecondProduct') }}</th>
                    <td> {{ App\Models\Product\Product::where('id','=',$vedio->product_id)->pluck('name')->first() }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.orders.table.quantity') }} (Vedio)</th>
                    <td> {{ $vedio->product_quantity }} </td>
                </tr>
            @endforeach
            

            

            


            <!-- Website Music -->
            <tr>
                <th ><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.music') }} <h5></th>
                <td>
                    @if(!empty($order->musicSample))
                    <audio controls style="height:54px;" ><source src='{{Storage::disk('public')->url('smaples/'.$order->musicsample->url)}}' ></audio></td>
                    @else
                        <p style="margin-top:20px;">There is No Music Sample</p>
                    @endif
            </tr>

            <!-- User Music -->
            <tr>
                <th> <h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.user_music') }} </h5> </th>
                <td> 
                    @if($order->user_music)
                        <audio controls style="height:54px;" ><source src='{{Storage::disk('public')->url('users_music/'.$order->user_music)}}' ></audio></td>
                    @else
                        <p style="margin-top:20px;">There is No User Music</p>
                    @endif
                </td>
            </tr>

            

            <tr>
                <th>{{ trans('labels.backend.orders.table.videoLength') }}</th>
                <td> {{ $order->video_length}} minute</td>
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


           
            <!-- <tr>
                <th>{{ trans('labels.backend.orders.download_file') }}</th>
                <td> <a href="{{ route('admin.filedownload',$order) }}" class="btn btn-success"> Download </a> </td>
            </tr> -->


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
