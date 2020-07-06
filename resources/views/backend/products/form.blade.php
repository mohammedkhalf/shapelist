<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.products.table.Name'),['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name', old('name'), ['class' => 'form-control box-size' ,'placeholder' => trans('labels.backend.products.product-name')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('name_ar', trans('labels.backend.products.table.Name_ar'),['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control box-size' ,'placeholder' => trans('labels.backend.products.table.Name_ar')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('description', trans('validation.attributes.backend.products.description'),['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::textarea('description', old('description'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.description'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('description_ar', trans('labels.backend.products.table.Description_ar'),['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.Description_ar'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
          {{ Form::label('image', trans('validation.attributes.backend.products.image'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {!! Form::file('image', old('image')  ,array('class'=>'form-control inputfile inputfile-1')) !!} <br/>
            <img src= "{{ Storage::disk('public')->url('product_images/'.$product->image) }}" width="200" height="100" alt="Card image cap">
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('price', trans('validation.attributes.backend.products.price'),['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::text('price', old('price'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.price'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{-- {{ Form::label('points', trans('labels.backend.products.table.points'),['class' => 'col-lg-2 control-label required']) }} --}}

        {{-- <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::text('points', old('points'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.points'), 'required' => 'required']) }}
        </div><!--col-lg-10--> --}}
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
