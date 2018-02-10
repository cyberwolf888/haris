@extends('layouts.frontend')

@section('content')
    <!-- Page Banner Area
    ============================================ -->
    <div id="page-banner" class="page-banner-area top-header-space-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-banner text-center"><h2>Contact</h2></div>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Page
    ============================================ -->
    <div class="page-area pb-90 pt-90">
        <div class="container">
            <div class="row">
                <div class="contact-form col-lg-8  col-md-7 col-xs-12">
                    <h3>LEAVE A MESSAGE</h3>
                    <form id="contact-form" action="{{ route('frontend.contact.proses') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-box-2 fix">
                            <div class="input-box float-left">
                                <input name="name" placeholder="Name*" type="text">
                            </div>
                            <div class="input-box float-left">
                                <input name="subject" placeholder="Subject" type="text">
                            </div>
                        </div>
                        <div class="input-box-2 fix">
                            <div class="input-box float-left">
                                <input name="email" placeholder="E-mail*" type="text">
                            </div>
                            <div class="input-box float-left">
                                <input name="phone" placeholder="Phone" type="text">
                            </div>
                        </div>
                        <div class="input-box review-box fix">
                            <textarea name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="input-box submit-box fix">
                            <input value="Send Message" type="submit">
                        </div>
                    </form>
                    <p class="form-messege"></p>
                </div>
                <div class="contact-info col-lg-4  col-md-5 col-xs-12">
                    <h3>GET INFORMED</h3>
                    <div class="sin-con-info fix">
                        <div class="content fix">
                            <p class="name">Customer Service</p>
                            <p class="title">MANAGER of SLASHROCK</p>
                            <p class="info"><i class="zmdi zmdi-phone-in-talk"></i><span>Phone : +061012345678</span></p>
                            <p class="info"><i class="zmdi zmdi-email"></i><span>manager@outlook.com</span></p>
                        </div>
                    </div>
                    <div class="sin-con-info fix">
                        <div class="content fix">
                            <p class="name">System Admin</p>
                            <p class="title">MANAGER of SLASHROCK</p>
                            <p class="info"><i class="zmdi zmdi-phone-in-talk"></i><span>Phone : +061012345678</span></p>
                            <p class="info"><i class="zmdi zmdi-email"></i><span>info@outlook.com</span></p>
                        </div>
                    </div>
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
