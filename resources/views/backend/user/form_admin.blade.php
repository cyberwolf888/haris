@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    {!! Form::open(['route' => isset($update) ? ['backend.user.admin.update', $model->id] :'backend.user.admin.store', 'method' => 'post']) !!}
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Admin</div>
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
                        <span class="card-title">Data User</span><br>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="fullname" id="fullname" type="text" class="validate" value="{{ $model->name }}" required="" aria-required="true">
                                <label for="fullname" data-error="wrong" data-success="valid">Full Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="email" id="email" type="email" class="validate" value="{{ $model->email }}" required="" aria-required="true">
                                <label for="email" data-error="wrong" data-success="valid">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="phone" id="phone" type="number" class="validate" value="{{ $model->phone }}" required="" aria-required="true">
                                <label for="phone" data-error="not valid" data-success="valid">Phone Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="address" id="address" type="text" class="validate" value="{{ $model->address }}" required="" aria-required="true">
                                <label for="address" data-error="not valid" data-success="valid">Address</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                {!! Form::select('city', $model->getListCity(), $model->city) !!}
                                {!! Form::label('city', 'City') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password" id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password_confirmation" id="password_confirmation" type="password" class="validate">
                                <label for="password_confirmation">Password Confirmation</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="switch m-b-md">
                                <label>
                                    Deactive
                                    <input type="checkbox" name="status" {{ $model->isActive != 0 ? 'checked' : '' }}>
                                    <span class="lever"></span>
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l12">
                {!! Form::submit('Save',['class'=>'waves-effect waves-light btn light-blue']) !!}
                <button type="button" class="btn red" onclick="window.location = '{{ route('backend.user.admin.manage') }}';">Back</button>
            </div>

        </div>
    </main>
    {!! Form::close() !!}
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
@endpush