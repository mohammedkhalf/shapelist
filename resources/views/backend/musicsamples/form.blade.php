<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.musicsamples.table.name'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.musicsamples.table.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <!-- <div class="form-group">
        {{ Form::label('type', trans('labels.backend.musicsamples.table.type'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
        {{ Form::text('type', old('type'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.musicsamples.table.name')]) }}
        </div>
    </div> -->

    <div class="form-group">
        {{ Form::label('url', trans('labels.backend.musicsamples.table.url'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {!! Form::file('url', array('class'=>'form-control inputfile inputfile-1' , 'required' => 'required' )) !!}
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
