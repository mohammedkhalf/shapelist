<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.faqcategories.table.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(isset($faqcategory))
              {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.faqcategories.table.name'), 'required' => 'required' ,'readonly' => 'true']) }}
            @else
              {{ Form::text('name', old('name'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.faqcategories.table.name'), 'required' => 'required' ]) }}
            @endif
            </div><!--col-lg-10-->
    </div><!--form-group-->
</div><!--box-body-->
