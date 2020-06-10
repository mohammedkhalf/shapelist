
<div class="box-body">
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

    <!-- <div class="form-group">
        {{ Form::label('download_file', trans('labels.backend.orders.download_file'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
  
            <input name="download_file" type="file" class="form-control " id="imgInp" onchange="loadFile(event)" accept="image/* ,video/*">
            <img id="output">
                @if(isset($order))
                <td> <a href="{{ route('admin.filedownload',$order) }}">{{ $order->download_file}}</a></td>
                @endif
        </div>
    </div> -->

</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //   var loadFile = function(event) {
        //     var output = document.getElementById('output');
        //     output.src = URL.createObjectURL(event.target.files[0]);
        //     output.onload = function() {
        //     URL.revokeObjectURL(output.src) 
 
        //         }
        //     };
                
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
