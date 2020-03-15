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
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
