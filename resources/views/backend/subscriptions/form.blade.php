<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.subscriptions.table.name'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('purchase_points', trans('labels.backend.subscriptions.table.purchase_points'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('purchase_points', old('purchase_points'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.purchase_points'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('free_points', trans('labels.backend.subscriptions.table.free_points'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('free_points', old('free_points'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.free_points'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('discount', trans('labels.backend.subscriptions.table.discount'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('discount', old('discount'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.discount'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('details', trans('labels.backend.subscriptions.table.details'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('details', old('details'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.details')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('duration', trans('labels.backend.subscriptions.table.duration'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('duration', old('duration'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.duration')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('price', trans('labels.backend.subscriptions.table.price'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('price', old('price'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.price')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->




</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        $( document ).ready( function() {

        });
    </script>
@endsection
