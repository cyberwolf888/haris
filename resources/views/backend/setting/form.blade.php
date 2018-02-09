@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    {!! Form::open(['route' => isset($update) ? ['backend.setting.update', $model->id] :'backend.setting.store', 'method' => 'post', 'files' => true]) !!}
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Setting</div>
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
                                    {!! Form::text('type', $model->type,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('name', 'Type', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::text('value', $model->value,['class'=>'validate','required'=>'','aria-required'=>'true']) !!}
                                    {!! Form::label('name', 'Value', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l12">
                {!! Form::submit('Save',['class'=>'waves-effect waves-light btn light-blue']) !!}
                <button type="button" class="btn red" onclick="window.location = '{{ route('backend.setting.manage') }}';">Back</button>
            </div>

        </div>
    </main>
    {!! Form::close() !!}
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
@endpush