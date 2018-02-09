@extends('layouts.frontend')

@section('content')
    <!-- Page Banner Area
    ============================================ -->
    <div id="page-banner" class="page-banner-area top-header-space-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-banner text-center"><h2>Register</h2></div>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>Register</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Demo Content Area
    ============================================ -->
    <div class="page-area pb-90 pt-90">
        <div class="container">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-offset-4 col-lg-4  col-md-4 col-xs-12">
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert"><span>×</span></button>
                            <strong>Oh Snap!</strong> <br>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="contact-form col-md-offset-4 col-lg-4  col-md-4 col-xs-12">
                    <h3>Register Form</h3>
                    <form id="payment-form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="fullname" placeholder="Nama Lenkap" type="text" value="{{ old('fullname') }}" autofocus required>
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="email" placeholder="Email" type="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="phone" placeholder="Nomer HP" type="text" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="address" placeholder="Alamat" type="text" value="{{ old('address') }}" required>
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <?php $city = new \App\User(); ?>
                                {!! Form::select('city', $city->getListCity(), old('city')) !!}
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="password" placeholder="Password" type="Password" required>
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left" style="width: 100%">
                                <input name="password_confirmation" placeholder="Password Confirmation" type="password" required>
                            </div>
                        </div>
                        <div class="input-box submit-box fix">
                            <input value="Register" type="submit">
                        </div>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin_scripts')
<!-- Particles Active JS
============================================ -->
<script src="{{ url('assets/frontend') }}/js/app.js"></script>
@endpush
