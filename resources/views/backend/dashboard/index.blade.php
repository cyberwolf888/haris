@extends('layouts.backend')

@push('plugin_css')
    <link href="{{ url('assets/backend') }}/plugins/chartist/dist/chartist.min.css" type="text/css" rel="stylesheet">
    <style>
        .ct-bar {
            fill: none;
            stroke-width: 25px;
        }

    </style>
@endpush

@section('content')
    <main class="mn-inner inner-active-sidebar">
            <div class="row no-m-t no-m-b">
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">
                            <div class="card-options">
                                <ul>
                                    <li class="red-text"><span class="badge cyan lighten-1">netto</span></li>
                                </ul>
                            </div>
                            <span class="card-title">Sales</span>
                            <span class="stats-counter">Rp <span class="">{{ number_format($sales,0,',','.') }}</span><small>This week</small></span>
                        </div>
                        <div class="progress stats-card-progress">
                            <div class="determinate" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">
                            <div class="card-options">
                                <!-- <ul>
                                    <li><a href="javascript:void(0)"><i class="material-icons">more_vert</i></a></li>
                                </ul> -->
                            </div>
                            <span class="card-title">Total Visitor</span>
                            <span class="stats-counter"><span class="counter">{{ $visitor }}</span><small>Today</small></span>
                        </div>
                        <div class="progress stats-card-progress">
                            <div class="determinate" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">
                            <span class="card-title">Total Transaction</span>
                            <span class="stats-counter"><span class="counter">{{ $count_transaction }}</span><small>This week</small></span>
                        </div>
                        <div class="progress stats-card-progress">
                            <div class="determinate" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row no-m-t no-m-b">
            <div class="col s12 m12 l12">
                <div class="card invoices-card">
                    <div class="card-content">
                        <div class="card-options">
                        </div>
                        <span class="card-title">Diagram Penjualan</span>
                        <div class="ct-chart-distributed ct-chart ct-golden-section" style="max-height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('plugin_scripts')
<script src="{{ url('assets/backend') }}/plugins/counter-up-master/jquery.counterup.min.js"></script>
<script src="{{ url('assets/backend') }}/plugins/chartist/dist/chartist.min.js"></script>        <!-- Chartist -->
@endpush

@push('scripts')
<script>
    $( document ).ready(function() {
        new Chartist.Bar('.ct-chart-distributed', {
            labels: <?= $labels ?>,
            series: <?= $series ?>
        }, {
            distributeSeries: true
        });

        // CounterUp Plugin
        $('.counter').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 3500,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                    $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                }
            });
        });
    });
</script>
@endpush