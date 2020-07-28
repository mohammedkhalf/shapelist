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
        {{ Form::label('description', trans('validation.attributes.backend.products.description'),['class' => 'col-lg-2 control-label']) }}
        <div class="col-md-4">
          {{ Form::textarea('description', old('description'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.description')]) }}
        </div><!--col-lg-10-->
    </div><!--col-lg-10-->

    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('description_ar', trans('labels.backend.products.table.Description_ar'),['class' => 'col-lg-2 control-label required']) }}
        <div class="col-md-4">
          {{ Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.description_ar')]) }}
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
        tinymce.init({
            forced_root_block : false,
            selector:'textarea',
            width: 800,
            height: 150
        });
    </script>
@endsection
