<div class="box-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
            @endif
        <div class="form-group">
            {{ Form::label('statusType', trans('labels.backend.orders.statusType'), ['class' => 'col-lg-2 control-label required']) }}
            <div class="col-lg-10">
                <select class="form-control" name="status_id">
                        @foreach ($statusesData  as $statusObj)
                            <option value="{{ $statusObj->id }}" {{ $statusObj->id == $order->status_id ? 'selected="selected"' : '' }}> 
                                {{ $statusObj->type }} 
                            </option>

                        @endforeach    
                </select>
            </div><!--col-lg-10-->
        </div><!--form-group-->

        <div class="form-group">  
            {{ Form::label('Media Files', trans('labels.backend.orders.Media-Files'), ['class' => 'col-lg-2 control-label required']) }}
            <div class="col-lg-10">
                <div class="input-group hdtuto control-group lst increment" >
                    <input type="file" name="media_file" class="myfrm form-control"/>
                </div>
            </div>
        </div>
        <br>
        @if(!empty($upload))
            <h4 class="box-title"> Media Details</h4>
            <div class="table-responsive data-table-wrapper">
                <table class="table table-condensed table-hover table-bordered">
                    <thead style="background-color:#22A67E; color:white">
                        <td> order id</td>
                        <td> file name</td>
                        <td> size</td>
                        <td> create at</td>
                        <td> download </td>
                    </thead>
                    <tbody  class="transparent-bg">
                        <td> {{$upload->order_id}}</td>
                        <td> {{$upload->zip_name}}</td>
                        <td>{{ $upload->size }} MB</td>
                        <td>{{$upload->created_at}} </td>
                        <td> 
                            <a href={{ Storage::disk('s3')->url($upload->path)}} class="fa fa-download">                               
                            </a>
                        </td>
                    </tbody>
                </table> 
            </div>
        @endif   


</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript"> 
        
        // $( document ).ready( function() {
        //         $(".btn-success").click(function(){ 
        //             var lsthmtl = $(".clone").html();
        //             $(".increment").after(lsthmtl);
        //         });
        //         $("body").on("click",".btn-danger",function(){ 
        //             $(this).parents(".hdtuto").remove();
        //         });
        // });
    </script>
@endsection
