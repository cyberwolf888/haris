@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    {!! Form::open(['route' => isset($update) ? ['backend.product.update', $model->id] :'backend.product.store', 'method' => 'post']) !!}
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Product</div>
            </div>
            @if (count($errors) > 0)
                <div class="col m12">
                    <div class="card-panel red lighten-1">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::text('name', $model->name,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('name', 'Product Name', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::select('category_id', App\Models\Category::pluck('name','id'), $model->category_id) !!}
                                    {!! Form::label('category_id', 'Category') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::number('price', $model->price,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('price', 'Product Price', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::number('weight', $model->weight,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('weight', 'Product Weight (kg)', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::number('discount', $model->discount == null ? 0: $model->discount,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('discount', 'Discount (%)', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::textarea('description', $model->description,['class'=>'materialize-textarea validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('description', 'Description', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::select('isSale', ['1'=>'Yes','0'=>'No'], $model->isSale) !!}
                                    {!! Form::label('isSale', 'Is Sale?') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::select('available', ['1'=>'Enable','0'=>'Disable'], $model->available) !!}
                                    {!! Form::label('available', 'Available') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            @if(!isset($update))
                                <div class="input_fields_wrap">
                                    <div class="row">
                                        <div class="col m5">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success add_field_button">Add More Fields</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s5">
                                            <i class="material-icons prefix">delete</i>
                                            {!! Form::select('label[]', \App\Models\Setting::where('type','product_detail')->pluck('value','value')) !!}
                                            {!! Form::label('label[]', 'Label') !!}
                                        </div>
                                        <div class="input-field col s7">
                                            {!! Form::text('value[]', null,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                            {!! Form::label('label[]', 'Value') !!}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="input_fields_wrap">
                                    <div class="row">
                                        <div class="col m5">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success add_field_button">Add More Fields</button>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($model->product_detail as $detail)
                                    <div class="row">
                                        <div class="input-field col s5">
                                            <i class="material-icons prefix remove_field">delete</i>
                                            {!! Form::select('label[]', \App\Models\Setting::where('type','product_detail')->pluck('value','value'), $detail->label) !!}
                                            {!! Form::label('label[]', 'Label') !!}
                                        </div>
                                        <div class="input-field col s7">
                                            {!! Form::text('value[]', $detail->value, ['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                            {!! Form::label('label[]', 'Value') !!}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l12">
                {!! Form::submit('Save',['class'=>'waves-effect waves-light btn light-blue']) !!}
                <button type="button" class="btn red" onclick="window.location = '{{ route('backend.product.manage') }}';">Back</button>
            </div>

        </div>
    </main>
    {!! Form::close() !!}
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                $(wrapper).append('<div class="row">' +
                        '<div class="input-field col s5">' +
                        '<i class="material-icons prefix remove_field">delete</i>' +
                        '<?php echo Form::select('label[]', \App\Models\Setting::where('type','product_detail')->pluck('value','value')); ?>' +
                        '<?php echo Form::label('label[]', 'Label'); ?>' +
                        '</div> ' +
                        '<div class="input-field col s7">' +
                        '<?php echo Form::text('value[]', null,['class'=>'validate','required'=>'','aria-required'=>'true']); ?> ' +
                        '<?php echo Form::label('label[]', 'Value'); ?>' +
                        '</div>' +
                        '</div>' ); //add input box
                $('select').material_select();
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
        })
    });
</script>
@endpush