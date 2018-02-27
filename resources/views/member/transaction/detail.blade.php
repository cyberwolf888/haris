@extends('layouts.member')

@push('plugin_css')
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Detail Transaction</div>
            </div>
            @if($model->status == \App\Models\Transaction::NEW_ORDER)
                <div class="col s12">
                    <a class="waves-effect waves-light btn green" href="{{ route('frontend.payment',base64_encode($model->id)) }}"><i class="material-icons left">done</i>Bayar Sekarang</a>
                </div>
            @endif
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <ul class="collection">
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Order No</span><br>
                                    <b>{{ $model->id }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Nama Lengkap</span><br>
                                    <b>{{ $model->fullname }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">No Telp</span><br>
                                    <b>{{ $model->phone }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Alamat</span><br>
                                    <b>{{ $model->address.', '.$model->city }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">status</span><br>
                                    <b>{{ $model->getStatus($model->status) }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Subtotal</span><br>
                                    <b>Rp {{ number_format($model->subtotal,0,',','.') }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Ongkos Kirim</span><br>
                                    <b>Rp {{ number_format($model->shipping,0,',','.') }}</b>
                                </li>
                                <li class="collection-item">
                                    <span class="grey-text text-lighten-1">Total</span><br>
                                    <b>Rp {{ number_format($model->total,0,',','.') }}</b>
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
                                @foreach($model->transaction_detail as $detail)
                                    <li class="collection-item">
                                        <span class="grey-text text-lighten-1">{{ \App\Models\Product::find($detail->product_id)->name }}</span><br>
                                        Price: Rp {{ number_format($detail->price,0,',','.') }}<br>
                                        Size: {{ $detail->size }}<br>
                                        Qty: {{ $detail->qty }}<br>
                                        Total: Rp {{ number_format($detail->total,0,',','.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($model->payment != null)
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Detail Payment</div>
                </div>
                <div class="col s12 m12 12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                @foreach($model->payment as $payment)
                                    <div class="col s4 m4 ">
                                        <br><br>
                                        <a href="{{ url('assets/img/payment/'.$payment->image) }}" target="_blank"><img src="{{ url('assets/img/payment/'.$payment->image) }}" style="width: 300px; height: 300px;"></a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endif
    </main>
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
<script>
</script>
@endpush