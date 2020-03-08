<div class="box-body">
    <div class="form-group">
  
        {{ Form::label('code', trans('labels.backend.coupons.table.code'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">

        {{ Form::text('code', old('code'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.code'), 'required' => 'required']) }}
        </div>
    </div><!--form-group-->

    <div class="form-group">
  
        {{ Form::label('amount', trans('labels.backend.coupons.table.amount'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">

        {{ Form::text('amount', old('amount'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.amount'), 'required' => 'required']) }}
        </div>
    </div><!--form-group-->

    <div class="form-group">
  
        {{ Form::label('valid', trans('labels.backend.coupons.table.valid'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">

        {{ Form::checkbox('valid', '1' , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.coupons.table.valid'), 'required' => 'required'] ) }}

        </div>
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
