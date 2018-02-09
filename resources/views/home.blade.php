@extends('layouts.frontend')

@section('content')

    <!-- Home Slider============================================ -->
    <div class="slider-area-1 top-header-space-1  pb-90">
        <div id="mainSlider-1" class="nivoSlider slider-image">
            <a href="#" class="nivo-imageLink">
                <img src="{{ url('assets/frontend') }}/img/slider/1.jpg" alt="main slider">
            </a>
            <a href="#" class="nivo-imageLink">
                <img src="{{ url('assets/frontend') }}/img/slider/2.jpg" alt="main slider">
            </a>
            <a href="#" class="nivo-imageLink">
                <img src="{{ url('assets/frontend') }}/img/slider/6.jpg" alt="main slider">
            </a>
        </div>
    </div>

    <!-- Shipping Area============================================ -->
    <div class="shipping-area  pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="shipping-wrapper-1">
                        <!-- Single Shipping -->
                        <div class="sin-shipping-1 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12">
                            <div class="icon float-left">
                                <i class="zmdi zmdi-car"></i>
                            </div>
                            <div class="content fix">
                                <h4>FREE SHOP ALL ORDER</h4>
                                <p>Gratis ongkos kirim untuk daerah Denpasar & Badung</p>
                            </div>
                        </div>
                        <!-- Single Shipping -->
                        <div class="sin-shipping-1 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12">
                            <div class="icon float-left">
                                <i class="zmdi zmdi-balance-wallet"></i>
                            </div>
                            <div class="content fix">
                                <h4>Best Price</h4>
                                <p>Kami menawarkan harga terbaik untuk anda</p>
                            </div>
                        </div>
                        <!-- Single Shipping -->
                        <div class="sin-shipping-1 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12">
                            <div class="icon float-left">
                                <i class="zmdi zmdi-headset"></i>
                            </div>
                            <div class="content fix">
                                <h4>24/7 SUPPORT</h4>
                                <p>Layanan customer service setiap saat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Area============================================ -->
    <div class="products-area  pb-40">
        <div class="container">
            <div class="row">
                <div class="product-tab">

                    @foreach(\App\Models\Product::where('available','1')->orderBy('id','desc')->limit(8)->get() as $product)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="sin-product">
                            @if($product->isSale == 1)
                            <span class="pro-label">sale</span>
                            @endif
                            <div class="pro-image fix">
                                <a href="{{ route('frontend.product_detail',['id'=>$product->id]) }}" class="image"><img src="{{ $product->getImage() }}" alt=""></a>
                                <div class="pro-action">
                                    <a href="{{ route('frontend.product_detail',['id'=>$product->id]) }}" class="action-btn cart"><i class="zmdi zmdi-shopping-cart"></i></a>
                                    <a href="{{ route('frontend.product_detail',['id'=>$product->id]) }}" class="action-btn quick-view"><i class="zmdi zmdi-eye"></i></a>
                                </div>
                            </div>
                            <div class="pro-details text-center">
                                <div class="top fix">
                                    <p class="pro-cat float-left">{{ $product->category->name }}</p>
                                    <p class="pro-ratting float-right">
                                        Available
                                    </p>
                                </div>
                                <a href="{{ route('frontend.product_detail',['id'=>$product->id]) }}" class="pro-title">{{ $product->name }}</a>
                                @if($product->discount > 0)
                                    <span class="new"><strike>Rp {{ number_format($product->price,0,',','.') }}</strike></span>
                                    <h3 class="pro-price" style="margin-top: 0;"><span class="new">Rp {{ number_format($product->price-($product->price*$product->discount/100),0,',','.') }}</span></h3>
                                @else
                                    <h3 class="pro-price" style="margin-bottom: 14px;"><span class="new">Rp {{ number_format($product->price,0,',','.') }}</span></h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
