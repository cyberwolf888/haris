@extends('layouts.frontend')

@section('content')
    <!-- Page Banner Area
    ============================================ -->
    <div id="page-banner" class="page-banner-area top-header-space-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-banner text-center"><h2>Checkout</h2></div>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Area
    ============================================ -->
    <div class="checkout-area pb-90 pt-90">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="billing-details">
                        <h4>billing details</h4>
                        <form action="{{ route('frontend.checkout.proses') }}" method="post" id="checkout-form">
                            {{ csrf_field() }}
                            <input type="text" name="name" placeholder="Your Name" value="{{ Auth::user()->name }}" readonly />
                            <input type="text" name="phone" placeholder="Phone Here" value="{{ Auth::user()->phone }}" readonly />
                            <input type="text" name="city" placeholder="Town / City" value="{{ Auth::user()->city }}" readonly />
                            <input type="text" name="address" placeholder="Address" value="{{ Auth::user()->address }}" />
                            <textarea name="note" placeholder="Note Message"></textarea>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="order-payment">
                        <h4>your order</h4>
                        <ul>
                            <?php $berat = 0; ?>
                            @foreach(Cart::instance('cart')->content() as $cart)
                                <?php $berat+=($cart->model->weight*$cart->qty); ?>
                                <li><span class="name">{{ $cart->name }}  x {{ $cart->qty }}</span><span class="price">Rp {{ number_format($cart->price*$cart->qty,0,',','.') }}</span></li>
                            @endforeach
                            <li><span class="name"><b>Subtotal</b></span><span class="price">Rp {{ \Cart::instance('cart')->total() }}</span></li>
                            <li>
                                <span class="name"><b>Shipping</b></span><span class="price">
                                    <?php $shipping = 0; ?>
                                    @if(Auth::user()->city == "Denpasar" || Auth::user()->city == "Badung")
                                        FREE
                                    @else
                                        <?php $shipping = $berat*\App\Models\Setting::find(1)->value; ?>
                                        Rp {{ number_format($shipping,0,',','.') }}
                                    @endif
                                </span>
                            </li>
                            <li><span class="name">Grand Total</span><span class="price">Rp {{ number_format($shipping+\Cart::instance('cart')->total(0,'',''),0,',','.') }}</span></li>
                        </ul>
                        <h4>payment method</h4>
                        <div class="panel-group" id="payment-accordion">
                            <div class="panel panel-default">
                                <h4 class="panel-title bg-white"><a data-toggle="collapse" data-parent="#payment-accordion" href="#payment-1">direct bank transfer</a></h4>
                                <div id="payment-1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>Silahkan transfer pembayaran langsung ke rekening Bank Kami.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="place-order" onclick="event.preventDefault();document.getElementById('checkout-form').submit();">place order</button>
                        <br><br>
                        <p><b>Note</b>: Barang akan dikirim paling lambat 7 hari setelah pembayaran dikonfirmasi jika ketersediaan barang kurang atau tidak tersedia.</p>
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
