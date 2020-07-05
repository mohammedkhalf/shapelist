<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.subscriptions.table.name'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('name_ar', trans('labels.backend.subscriptions.table.name_ar'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subscriptions.table.name_ar'), 'required' => 'required']) }}
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

    <div class="form-group">
        {{ Form::label('delivery_id', trans('labels.backend.subscriptions.table.delivery_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            <select class="form-control box-size" name="delivery_id">
            <option value="0"> --- </option>
            @foreach($deliveries as $delivery)
                @if(isset($subscription))
                <option value="{{$delivery->id}}" {{ $delivery->id == $subscription->delivery_id ? 'selected' : '' }}> {{$delivery->name_en}} </option>
                @else
                <option value="{{$delivery->id}}" {{ old('delivery_id') == $delivery->id ? 'selected' : '' }}> {{$delivery->name_en}} </option>
                @endif
            @endforeach
        </select>     
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('priority_support', trans('labels.backend.subscriptions.table.priority_support'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-2">
            @if(isset($subscription))     
            <select class="form-control box-size" name="priority_support">    
                <option value="1" {{ $priority == 1 ? 'selected' : '' }}> Yes </option>
                <option value="0" {{ $priority == 0 ? 'selected' : '' }}> No </option>
            </select>
            @else
            <input type="checkbox" name="priority_support" value="1" {{ old('priority_support') ? 'checked="checked"' : '' }}/>
            @endif
        </div><!--col-lg-10-->
    </div><!--form-group-->



</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        $( document ).ready( function() {

        });
    </script>
@endsection
