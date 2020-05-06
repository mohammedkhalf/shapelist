<div class="box-body">

    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
       {{ Form::label('name_en', trans('labels.backend.addons.table.name_en'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
        {{ Form::text('name_en', old('name_en'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.name_en'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
       {{ Form::label('name_ar', trans('labels.backend.addons.table.name_ar'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
        {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.name_ar'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    

    <!-- <div class="form-group">
        {{ Form::label('type', trans('labels.backend.addons.table.type'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('type', old('type'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.type'), 'required' => 'required']) }}
        </div>
    </div> -->

    <div class="form-group">
       {{ Form::label('description_en', trans('labels.backend.addons.table.description_en'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('description_en', old('description_en'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.description_en'), 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group">
       {{ Form::label('description_ar', trans('labels.backend.addons.table.description_ar'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('description_ar', old('description_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.description_ar'), 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group">
       {{ Form::label('price', trans('labels.backend.addons.table.price'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('price', old('price'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.addons.table.price'), 'required' => 'required']) }}
        </div>
    </div>

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
