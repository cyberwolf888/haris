@extends('layouts.frontend')

@section('content')
    <!-- Page Banner Area
    ============================================ -->
    <div id="page-banner" class="page-banner-area top-header-space-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-banner text-center"><h2>Cart</h2></div>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area
    ============================================ -->
    <div class="cart-area pb-90 pt-90">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="cart-table table-responsive mb-50">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="product">product</th>
                                <th class="price">price</th>
                                <th class="qty">quantity</th>
                                <th class="stock">Total</th>
                                <th class="remove">remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $berat = 0; ?>
                            @foreach(Cart::instance('cart')->content() as $cart)
                                <?php $berat+=($cart->model->weight*$cart->qty); ?>
                            <tr>
                                <td><div class="cart-product text-left fix">
                                        <img src="{{ $cart->model->getImage() }}" alt="" />
                                        <div class="details fix">
                                            <a href="#">{{ $cart->name }}</a>
                                            @foreach($cart->options as $key=>$option)
                                            <p>{{ $key }} : {{ $option }} @if($key=='Weight' || $key=='Berat') kg @endif </p>
                                            @endforeach
                                        </div>
                                    </div></td>
                                <td><p class="cart-price">Rp {{ number_format($cart->price,0,',','.') }}</p></td>
                                <td>
                                    <div class="cart-pro-qunantuty">
                                        <div class="pro-qty-2 fix">
                                            <input value="{{ $cart->qty }}" name="qtybutton" type="text" rowid="{{ $cart->rowId }}" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td><p class="cart-stock">Rp {{ number_format($cart->price*$cart->qty,0,',','.') }}</p></td>
                                <td><button class="cart-pro-remove" rowid="{{ $cart->rowId }}"><i class="zmdi zmdi-close"></i></button></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="procced-checkout col-md-offset-7 col-md-5 col-xs-12">
                    <h4>CART TOTAL</h4>
                    <ul>
                        <li><span class="name">Subtotal</span><span class="price">Rp {{ \Cart::instance('cart')->total() }}</span></li>
                        <li>
                            <span class="name">Shipping</span><span class="price">
                                <?php $shipping = 0; ?>
                                FREE
                            </span>
                        </li>
                        <li><span class="name">Grand Total</span><span class="price">Rp {{ number_format($shipping+\Cart::instance('cart')->total(0,'',''),0,',','.') }}</span></li>
                    </ul>
                    <a href="{{ route('frontend.checkout') }}" class="checkout-link">Procced to checkout</a>
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

@push('scripts')
<script>

    var $preQty2 = $('.pro-qty-2');
    $preQty2.append('<span class="inc qtybtn-2"><i class="zmdi zmdi-chevron-up"></i></span>');
    $preQty2.append('<span class="dec qtybtn-2"><i class="zmdi zmdi-chevron-down"></i></span>');
    $('.qtybtn-2').on('click', function() {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var rowId = $button.parent().find('input').attr("rowid");
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
        update_cart(rowId,newVal);
    });

    $('.cart-pro-remove').on('click', function() {
        var $button = $(this);
        var rowId = $button.attr("rowid");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?= route('frontend.cart.delete') ?>',
            type: 'POST',
            data: {rowId:rowId},
            success: function (data) {
                //console.log(data);
                location.reload();
            }
        });
    });

    function update_cart(rowid,qty)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?= route('frontend.cart.update') ?>',
            type: 'POST',
            data: {rowId:rowid,qty:qty},
            success: function (data) {
                //console.log(data);
                location.reload();
            }
        });
    }
</script>
@endpush
