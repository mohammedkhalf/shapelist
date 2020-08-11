<div class="box-body">
    <div class="form-group">
  
        {{ Form::label('code', trans('labels.backend.coupons.table.code'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-4">

        {{ Form::text('code', old('code'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.code'), 'required' => 'required']) }}
        </div>
    </div><!--form-group-->

    <div class="form-group">
  
        {{ Form::label('amount', trans('labels.backend.coupons.table.amount'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-4">

        {{ Form::text('amount', old('amount'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.amount'), 'required' => 'required']) }}
        </div>
    </div><!--form-group-->

    @if(isset($coupon))
        <div class="form-group">
    
            {{ Form::label('valid', trans('labels.backend.coupons.table.valid'), ['class' => 'col-lg-2 control-label required']) }}
            <div class="col-lg-3">

            <select class="form-control" name="valid">
                <option value="1" {{old('valid',$coupon->valid)=="1"? 'selected':''}} >Valid</option>
                <option value="2" {{old('valid',$coupon->valid)=="2"? 'selected':''}} >Not Valid</option>
            </select>
    
            <!-- {{ Form::checkbox('valid', '1' , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.valid'), 'required' => 'required'] ) }} -->

            </div>
        </div><!--form-group-->
    @endif 
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
