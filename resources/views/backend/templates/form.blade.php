<div class="box-body">
    <div class="form-group">
 
       {{ Form::label('name', trans('labels.backend.templates.table.name'), ['class' => 'col-lg-2 control-label required']) }} 
        <div class="col-lg-10">
         {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.templates.table.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
 
        {{ Form::label('image', trans('labels.backend.templates.table.image'), ['class' => 'col-lg-2 control-label required']) }} 
        <div class="col-lg-10">
            {!! Form::file('image',array('class'=>'form-control inputfile inputfile-1' , 'required' => 'required')) !!} <br/>
             <img src= "{{ Storage::disk('public')->url('templates/'.$template->image) }}" width="50" height="50" alt="Card image cap">

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
