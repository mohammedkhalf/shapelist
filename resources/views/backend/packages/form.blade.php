<div class="box-body"> 
    <div class="form-group">
        {{ Form::label('name_ar', trans('labels.backend.packages.table.name_ar'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.packages.table.name_ar'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('name_en', trans('labels.backend.packages.table.name_en'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('name_en', old('name_en'), ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.packages.table.name_en'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div id="sections">
        <div class="section">
            <fieldset>
                <legend class="text-center"></legend>

                    <div class="form-group">
                            {{ Form::label('product', trans('labels.backend.packages.table.product'), ['class' => 'col-lg-2 control-label required']) }}
                            <div class="col-md-9">
                                <select  class="form-control" id="product_id"  name="product_id[]">
                                    <option>Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--col-lg-10-->
                    </div>
                    <div class="form-group">
                            {{ Form::label('quantity', trans('labels.backend.packages.table.quantity'), ['class' => 'col-lg-2 control-label required']) }}
                            <div class="col-md-10">
                              <input  type="text" id="quantity" name="quantity[]" class="form-control box-size"  value="{{old('quantity')}}"  required/>
                            </div><!--col-lg-10-->
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-info addsection">{{ trans('labels.backend.packages.table.add-section') }} </button>
                        <button type="button" class="btn btn-secondary remove">{{ trans('labels.backend.packages.table.remove-section') }}</button>
                    </div>
            </fieldset>
        </div>
    </div>

    <div class="form-group">
        <hr/>
    </div>

    <div class="form-group">
        {{ Form::label('price', trans('labels.backend.packages.table.price'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('price', old('price'), ['class' => 'form-control box-size','required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('desc_ar', trans('labels.backend.packages.table.desc_ar'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('desc_ar', old('desc_ar'), ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('desc_en', trans('labels.backend.packages.table.desc_en'), ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('desc_en', old('desc_en'), ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->


            
    
            
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        $( document ).ready( function() {
            //define template
                var template = $('#sections .section:first').clone();

                //define counter
                var sectionsCount = 1;

                //add new section
                $('body').on('click', '.addsection', function() {

                    //increment
                    sectionsCount++;

                    //loop through each input
                    var section = template.clone().find(':input').each(function(){

                        //set id to store the updated section number
                        var newId = this.id + sectionsCount;

                        //update for label
                        $(this).prev().attr('for', newId);

                        //update id
                        this.id = newId;

                    }).end()

                    //inject new section
                    .appendTo('#sections');
                    return false;
                });

                //remove section
                $('#sections').on('click', '.remove', function() {
                    //fade out section
                    $(this).parent().fadeOut(300, function(){
                        //remove parent element (main section)
                        $(this).parent().parent().empty();
                        return false;
                    });
                    return false;
                });
           
        });
    </script>
@endsection
