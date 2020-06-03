<div class="box-body">
    @if(isset($payment))
    
            <div class="form-group">
            
                {{ Form::label('status', trans('labels.backend.payments.table.status'), ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-2">

                    <select class="form-control" name="status" id="status" onchange="showReason()" >
                        @if(isset($payment))
                            <option value="1" {{ $payment->status == 1 ? 'selected' : '' }}> True </option>
                            <option value="2" {{ $payment->status == 2 ? 'selected' : '' }}> False </option>
                        @else
                              none
                        @endif
                    </select>
                </div><!--col-lg-10-->
            </div><!--form-group-->

            <div class="form-group" id ="reason" style="display: none">
                    {{ Form::label('failure_reason', trans('labels.backend.payments.table.failure_reason'), ['class' => 'col-lg-2 control-label ']) }}
                <div class="col-lg-10">
                    {{ Form::textarea('failure_reason', old('failer_reason'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.payments.table.failure_reason')]) }}
                </div><!--col-lg-10-->
            </div><!--form-group-->
    @else
        <p>  &nbsp;&nbsp;  You Are Not allowed To Create Payments! <p>
    @endif

</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        $( document ).ready( function() {
            showReason();
        });

        function showReason() {
            $element = document.getElementById("status").value;
            if ($element == 2){
                 document.getElementById("reason").style.display = "block";
            }
            if ($element == 1){
                  document.getElementById("reason").style.display = "none";
            }
        }

    </script>
@endsection
