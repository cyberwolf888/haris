@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Detail Product</div>
            </div>

            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <ul class="collection">
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Name</span><br>
                                    <b>{{ $model->name }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Category</span><br>
                                    <b>{{ $model->category_id }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Price</span><br>
                                    <b>Rp {{ number_format($model->price,0,',','.') }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Discount</span><br>
                                    <b>{{ $model->discount }} %</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Sale</span><br>
                                    <b>{{ $model->isSale == 1 ? 'Yes' : 'No' }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Available</span><br>
                                    <b>{{ $model->available == 1 ? 'Yes' : 'No' }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">description</span><br>
                                    <b>{{ $model->description }}</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <ul class="collection">
                                @foreach($model->product_detail as $detail)
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">{{ $detail->label }}</span><br>
                                    <b>{{ $detail->value }}</b>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($model->product_images as $image)
                <div class="col s12 m6 l3">
                    <div class="card white">
                        <div class="card-content center">
                            <img style="width: 100%;" src="{{ url('assets/img/product/'.$model->id.'/'.$image->image) }}" >
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
@endpush