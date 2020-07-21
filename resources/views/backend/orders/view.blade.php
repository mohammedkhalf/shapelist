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
            @foreach($userProducts  as $orderInfo)
                   <!-- <tr>
                        <th> <h5> {{ trans('labels.backend.orders.Invoice') }}  </h5> </th>
                        <td> <a href="{{ route('admin.orders.preview',$orderInfo) }}"  target="_blank"> <button class="btn btn-info">Preview</button> </a> </td>
                    </tr> -->

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.firstname') }}</th>
                        <td>{{ !empty($orderInfo->users) ?  $orderInfo->users->first_name : '' }}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.lastname') }}</th>
                        <td>{{ !empty($orderInfo->users) ? $orderInfo->users->last_name : '' }}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.email') }}</th>
                        <td>{{ !empty($orderInfo->users) ? $orderInfo->users->email : '' }}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.phone') }}</th>
                        <td>
                            @if(!empty($orderInfo->users))
                            {{ $orderInfo->users->phone_number }}
                            @else
                                <p>There is No Phone Number</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.totalPrice') }}</th>
                        <td>{{ $orderInfo->total_price }} SAR </td>
                    </tr>
                    
                    <tr>
                        <th> <h5>{{ trans('labels.backend.orders.table.deliver_id') }} </h5> </th>
                        <td> 
                            @if($orderInfo->delivery_id == 1)  
                                <button class="btn btn-success"> Express </button>
                            @elseif($orderInfo->delivery_id == 2)
                                <button class="btn btn-success"> Fast </button>
                            @else
                                <button class="btn btn-success"> Standard </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th> <h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.OrderStatus') }} </h5> </th>
                        <td> <h5 class="btn btn-info"> {{ !empty($orderInfo->status) ? $orderInfo->status->type : '' }}</h5> </td> 
                    </tr>
            
                    <!-- <tr>
                        <th><h5 style="margin-top:20px;">{{ trans('labels.backend.orders.table.paymentStatus') }} </h5> </th>
                        <td> 
                            @if($orderInfo->payment_status == null)
                                <h4 class="btn btn-danger"> {{ trans('labels.backend.orders.table.NotPay') }} </h4>
                            @else
                            <h4 class="btn btn-success"> {{ trans('labels.backend.orders.table.PayDone') }} </h4>
                            @endif
                            
                        </td>
                    </tr> -->

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.onSet') }}</th>
                        <td>{{ $orderInfo->on_set }} </td>
                    </tr>
                    
                    <tr>
                        <th>{{ trans('labels.backend.orders.table.couponCode') }}</th>
                        <td>{{ $orderInfo->coupon_code }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.country') }}</th>
                        <td>  
                            {{ !empty($orderInfo->location) ? $orderInfo->location->country : '' }} 
                        </td> 
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.city') }}</th>
                        <td>  {{ !empty($orderInfo->location) ? $orderInfo->location->city : '' }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.address') }}</th>
                        <td>  {{ !empty($orderInfo->location) ? $orderInfo->location->address : '' }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.rep_first_name') }}</th>
                        <td>  {{ !empty($orderInfo->location) ? $orderInfo->location->rep_first_name : '' }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.rep_last_name') }}</th>
                        <td>  {{ !empty($orderInfo->location) ? $orderInfo->location->rep_last_name : '' }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.rep_phone_number') }}</th>
                        <td>  {{ !empty($orderInfo->location) ? $orderInfo->location->rep_phone_number : '' }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.orders.table.Num-Of-products-packages') }}</th>
                        <td> {{$totalCount}} </td>
                    </tr>
                    <!-- many to many relationship -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <!-- <th> {{ trans('labels.backend.orders.table.orderId') }}</th> -->
                                <th> {{ trans('labels.backend.orders.table.type') }}</th>
                                <th> {{ trans('labels.backend.orders.table.productName') }}</th>
                                <th>{{ trans('labels.backend.orders.table.productQuantity') }} </th>
                                <th>{{ trans('labels.backend.orders.table.music') }} </th>
                                <th>{{ trans('labels.backend.orders.table.videoLength') }} </th>
                                <th>{{ trans('labels.backend.orders.table.user_music') }} </th>
                            </tr>
                        </thead>
                        <thead class="transparent-bg">
                            @foreach($productsData  as  $productInfo)
                                <tr>
                                    <!-- <th>{{ $productInfo->product_id }}</th> -->
                                    <th>{{ $productInfo->type }}</th>
                                    <th>{{ App\Models\Product\Product::where('id', $productInfo->product_id)->pluck('name')->first() }}</th>
                                    <th>{{ $productInfo->quantity }}</th>
                                    <th>
                                        <?php
                                            $musicObj = App\Models\MusicSample\MusicSample::where('id',$productInfo->music_id)->get();
                                            foreach($musicObj  as $muObj)
                                            {
                                                $url=Storage::disk('public')->url('smaples/'.$muObj->url);
                                            }
                                        ?>
                                        @if($productInfo->music_id)
                                           <audio controls style="height:30px;"><source src={{$url}}></audio>
                                        @endif
                                    </th>
                                    <th>{{ $productInfo->video_length ? $productInfo->video_length : ''  }} {{ $productInfo->video_length ? 'Seconds' : '' }}</th>
                                    <th> 
                                        @if($productInfo->user_music)
                                            <audio controls style="height:30px;"><source src={{ Storage::disk('public')->url('users_music/'.$productInfo->user_music) }}></audio>
                                        @endif
                                    </th>
                                </tr>
                            @endforeach

                               @foreach($packageData  as $packageObj)
                                    <!-- <th> {{ $packageObj->package_id }}</th> -->
                                    <th> {{ $packageObj->type }}</th>
                                    <th> 
                                        <?php
                                            $packageName = App\Models\Package\Package::where('id',$packageObj->package_id)->pluck('name_en')->first();
                                            echo $packageName;
                                        ?>
                                    </th>
                                    <th> {{ $packageObj->quantity }} </th> 
                                    <th> 

                                        <?php
                                            $musicObj = App\Models\MusicSample\MusicSample::where('id',$packageObj->music_id)->get();
                                            foreach($musicObj  as $muObj)
                                            {
                                                $url=Storage::disk('public')->url('smaples/'.$muObj->url);
                                            }
                                        ?>
                                        @if($packageObj->music_id)                             
                                           <audio controls style="height:30px;margin-top:20px"><source src={{$url}}></audio>
                                        @endif

                                    </th> 
                                    <th>  {{ $packageObj->video_length }} {{ $packageObj->video_length ? 'Seconds' : '' }}</th>
                                    <th>
                                        @if( $packageObj->user_music)
                                            <audio controls style="height:30px;"><source src={{ Storage::disk('public')->url('users_music/'.$packageObj->user_music) }}></audio>
                                        @endif
                                    </th> 

                               @endforeach
                        </thead>
                    </table>
            @endforeach
        </table>
@endsection
