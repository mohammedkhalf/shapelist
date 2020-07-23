<div class="box-body">
    <div class="form-group">
        {{ Form::label('type', trans('labels.backend.statuses.table.type'), ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
        {{ Form::text('type', old('type'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.statuses.table.type'), 'required' => 'required' , 'readonly'=>'true']) }} 
        </div><!--col-lg-10-->
      
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('type_ar', trans('labels.backend.statuses.table.type_ar'), ['class' => 'col-lg-2 control-label required']) }} 
        <div class="col-lg-10">
        {{ Form::text('type_ar', old('type_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.statuses.table.type_ar'), 'required' => 'required']) }} 
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('icon', trans('labels.backend.statuses.table.icon'), ['class' => 'col-lg-2 control-label required']) }} 
        <div class="col-lg-10">
            {!! Form::file('icon',array('class'=>'form-control inputfile inputfile-1')) !!} <br/>
            <img  class="rounded-circle" src="{{ asset('storage/statuses/'.$status->icon)}}" width="50"   />

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
