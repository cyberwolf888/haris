@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Detail Transaction</div>
            </div>

            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            @if($model->status != \App\Models\Transaction::CANCEL && $model->status == \App\Models\Transaction::VERIFIED)
                                <a class="waves-effect waves-light btn blue modal-trigger" href="#modal_shipped"><i class="material-icons left">done</i>Shipp Order</a>
                            @endif
                            @if($model->status != \App\Models\Transaction::CANCEL && $model->status == \App\Models\Transaction::SHIPPED)
                                <a class="waves-effect waves-light btn green modal-trigger" href="#modal_finish"><i class="material-icons left">done</i>Finish Order</a>
                            @endif
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
                            @if($model->status != \App\Models\Transaction::CANCEL)
                                @if($model->status != \App\Models\Transaction::FINISH)
                                    <a class="waves-effect waves-light btn red modal-trigger" href="#modal_cacncel"><i class="material-icons left">clear</i>Cancel Order</a>
                                @endif
                            @endif
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
                                @if($payment->status == 0 && $model->status == \App\Models\Transaction::WAITING_VERIFIED)
                                    <a class="waves-effect waves-light btn green modal-trigger" href="#modal_approve" onclick="event.preventDefault();document.getElementById('payment_id').value = '<?= $payment->id ?>' ;"><i class="material-icons left">done</i>Approve</a>
                                    <a class="waves-effect waves-light btn red modal-trigger" href="#modal_decline" onclick="event.preventDefault();document.getElementById('payment_id').value = '<?= $payment->id ?>' ;"><i class="material-icons left">clear</i>Decline</a>
                                @endif
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
    <!-- Modal Structure -->
    <div id="modal_approve" class="modal">
        {!! Form::open(['route' => 'backend.transaction.approve', 'method' => 'post']) !!}
        <div class="modal-content">
            <h4>Approve</h4>
            <p>Are you sure to approve this payment?</p>
            {!! Form::hidden('transaction_id',$model->id) !!}
            {!! Form::hidden('payment_id',null,['id'=>'payment_id']) !!}
        </div>
        <div class="modal-footer">
            {!! Form::submit('Yes',['class'=>'waves-effect waves-green btn-flat']) !!}
            <a href="javascript:null;" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="modal_decline" class="modal">
        {!! Form::open(['route' => 'backend.transaction.decline', 'method' => 'post']) !!}
        <div class="modal-content">
            <h4>Decline</h4>
            <p>Are you sure to decline this payment?</p>
            {!! Form::hidden('transaction_id',$model->id) !!}
            {!! Form::hidden('payment_id',null,['id'=>'payment_id']) !!}
        </div>
        <div class="modal-footer">
            {!! Form::submit('Yes',['class'=>'waves-effect waves-green btn-flat']) !!}
            <a href="javascript:null;" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="modal_shipped" class="modal">
        {!! Form::open(['route' => 'backend.transaction.shipped', 'method' => 'post']) !!}
        <div class="modal-content">
            <h4>Cancel</h4>
            <p>Are you sure to shipp this transaction?</p>
            {!! Form::hidden('transaction_id',$model->id) !!}
        </div>
        <div class="modal-footer">
            {!! Form::submit('Yes',['class'=>'waves-effect waves-green btn-flat']) !!}
            <a href="javascript:null;" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="modal_finish" class="modal">
        {!! Form::open(['route' => 'backend.transaction.finish', 'method' => 'post']) !!}
        <div class="modal-content">
            <h4>Cancel</h4>
            <p>Are you sure to finish this transaction?</p>
            {!! Form::hidden('transaction_id',$model->id) !!}
        </div>
        <div class="modal-footer">
            {!! Form::submit('Yes',['class'=>'waves-effect waves-green btn-flat']) !!}
            <a href="javascript:null;" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="modal_cacncel" class="modal">
        {!! Form::open(['route' => 'backend.transaction.cancel', 'method' => 'post']) !!}
        <div class="modal-content">
            <h4>Cancel</h4>
            <p>Are you sure to cancel this transaction?</p>
            {!! Form::hidden('transaction_id',$model->id) !!}
        </div>
        <div class="modal-footer">
            {!! Form::submit('Yes',['class'=>'waves-effect waves-green btn-flat']) !!}
            <a href="javascript:null;" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
<script>
</script>
@endpush