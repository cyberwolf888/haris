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
