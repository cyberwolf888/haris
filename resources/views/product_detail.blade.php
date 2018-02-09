@extends('layouts.frontend')

@section('content')
    <!-- Page Banner Area
    ============================================ -->
    <div id="page-banner" class="page-banner-area top-header-space-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-banner text-center"><h2>Product Details</h2></div>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>Product Details</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Product Area
    ============================================ -->
    <div class="single-product-area pb-90 pt-90">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="single-product-wrap border">
                        <div class="single-product-image">
                            <div class="product-big-image tab-content">
                                @foreach($model->product_images as $row=>$img)
                                <div class="tab-pane @if($row==0) active @endif" id="pro-img-{{ $row }}">
                                    <img src="{{ url('assets/img/product/'.$model->id.'/thumb_'.$img->image) }}" alt="" />
                                    <a class="pro-img-popup" href="{{ url('assets/img/product/'.$model->id.'/'.$img->image) }}"><i class="zmdi zmdi-search"></i></a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="single-product-content fix">
                            <h3 class="single-pro-title">{{ $model->name }}</h3>
                            <div class="single-product-price-ratting fix">
                                <h3 class="single-pro-price float-left">
                                    @if($model->discount>0)
                                        <span class="new">Rp {{ number_format($model->price-($model->price*$model->discount/100),0,',','.') }}</span>
                                        <span class="old">Rp {{ number_format($model->price,0,',','.') }}</span>
                                    @else
                                        <span class="new">Rp {{ number_format($model->price,0,',','.') }}</span>
                                    @endif
                                </h3>
                            </div>
                            <p>{{ $model->description }}</p>
                            <div class="single-product-action-quantity fix">
                                <div class="pro-details-action float-left">
                                    <button id="btn_add" class="pro-details-act-btn btn-text active"><i class="zmdi zmdi-shopping-cart"></i>add to cart</button>
                                </div>
                                <div class="pro-qty float-right">
                                    <input value="1" name="qty" id="qty" class="cart-plus-minus-box" type="text">
                                </div>
                            </div>
                            <div class="pro-thumb-slider">
                                @foreach($model->product_images as $row=>$img)
                                    <div class="sin-item"><a @if($row==0) class="active" @endif href="#pro-img-{{ $row }}" data-toggle="tab"><img src="{{ url('assets/img/product/'.$model->id.'/thumb_'.$img->image) }}" alt="" /></a></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mt-40">
                    <div class="pro-details-tab-container fix">
                        <ul class="pro-details-tablist fix">
                            <li class="active"><a href="#spec" data-toggle="tab">information</a></li>
                        </ul>
                        <div class="tab-content fix">
                            <!-- Product Info Tab -->
                            <div id="spec" class="pro-details-tab pro-dsc-tab tab-pane active">
                                <div class="col-md-6">
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="30%">Wieght</td>
                                            <td><b>{{ $model->weight }} kg</b></td>
                                        </tr>
                                        @foreach($model->product_detail as $detail)
                                        <tr>
                                            <td width="30%">{{ $detail->label }}</td>
                                            <td><b>{{ $detail->value }}</b></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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

@push('scripts')
<script>
    $(document).ready(function () {
        $("#btn_add").click(function () {
            var qty = $("#qty").val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?= route('frontend.cart.insert') ?>',
                type: 'POST',
                data: {qty:qty, product_id:'<?= $model->id ?>'},
                success: function (data) {
                    //console.log(data);
                    location.reload();
                }
            });
        });
    })
</script>
@endpush
