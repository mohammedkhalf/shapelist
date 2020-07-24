<div class="box-body">
    <div class="form-group">
        {{ Form::label('name_en', trans('labels.backend.deliveries.table.name_en'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
         {{ Form::text('name_en', old('name_en'), ['class' => 'form-control box-size', 'placeholder' =>trans('labels.backend.deliveries.table.name_ar'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('name_ar', trans('labels.backend.deliveries.table.name_ar'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
         {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control box-size', 'placeholder' =>trans('labels.backend.deliveries.table.name_en'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('price', trans('labels.backend.deliveries.table.price'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
         {{ Form::text('price', old('price'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.deliveries.table.price'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group" >
            {{ Form::label('description_en', trans('labels.backend.deliveries.table.description_en'), ['class' => 'col-lg-2 control-label ']) }}
        <div class="col-lg-10">
            {{ Form::text('description_en', old('description_en'), ['class' => 'form-control box-size', 'placeholder' =>trans('labels.backend.deliveries.table.description_en')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group" >
            {{ Form::label('description_ar', trans('labels.backend.deliveries.table.description_ar'), ['class' => 'col-lg-2 control-label ']) }}
        <div class="col-lg-10">
            {{ Form::text('description_ar', old('description_ar'), ['class' => 'form-control box-size', 'placeholder' =>trans('labels.backend.deliveries.table.description_ar')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
            {{ Form::label('capacity', trans('labels.backend.deliveries.table.capacity'), ['class' => 'col-lg-2 control-label ']) }}
        <div class="col-lg-10">
            {{ Form::text('capacity', old('capacity'), ['class' => 'form-control box-size', 'placeholder' =>trans('labels.backend.deliveries.table.capacity')]) }}
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
