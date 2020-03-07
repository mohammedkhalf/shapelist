<div class="box-body">
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('name' ,trans('labels.backend.platforms.table.name'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
        {{ Form::text('name',  old('name') , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.platforms.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('image' ,trans('labels.backend.platforms.table.image'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {!! Form::file('image',array('class'=>'form-control inputfile inputfile-1')) !!} <br/>
               <img src= "{{ Storage::disk('public')->url('platform/'.$platform->image) }}" width="50" height="50" alt="Card image cap">

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
