<div class="box-body">
    <div class="form-group">
        {{ Form::label('question', trans('validation.attributes.backend.faqs.question'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('question', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.faqs.question'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('question_ar', trans('validation.attributes.backend.faqs.question_ar'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('question_ar', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.faqs.question_ar'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('answer', trans('validation.attributes.backend.faqs.answer'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('answer', null, ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('answer_ar', trans('validation.attributes.backend.faqs.answer_ar'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('answer_ar', null, ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('category_id', trans('labels.backend.faqs.table.categoryId'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            <select class="form-control box-size" name="category_id">
            <option value="0"> --- </option>
            @foreach($categories as $category)
                @if(isset($faq))
                <option value="{{$category->id}}" {{ $category->id == $faq->category_id ? 'selected' : '' }}> {{$category->name}} </option>
                @else
                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}> {{$category->name}} </option>
                @endif
            @endforeach
        </select>     
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('status', trans('validation.attributes.backend.faqs.status'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="control-group">
                <label class="control control--checkbox">
                    @if(isset($faq->status))
                        {{ Form::checkbox('status', 1, $faq->status == 1 ? true :false) }}
                    @else
                        {{ Form::checkbox('status', 1, true) }}
                    @endif
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-3-->
    </div><!--form control-->
    <div class="form-group">
</div><!--form control-->

</div>
@section('after-scripts')
    <script type="text/javascript">
        Backend.Faq.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
    </script>
@endsection