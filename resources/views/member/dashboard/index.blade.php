@extends('layouts.member')

@section('content')
    <main class="mn-inner inner-active-sidebar">
        <div class="row no-m-t no-m-b">
            <div class="col s12 m12 l12">
                <div class="card invoices-card">
                    <div class="card-content">
                        <div class="card-options">
                        </div>
                        <span class="card-title">Last 5 Transaction</span>
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transaction as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->fullname }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ 'Rp '.number_format($row->total,0,',','.') }}</td>
                                    <td>{{ $row->getStatus($row->status) }}</td>
                                    <td>{{ date("d M Y, H:i",strtotime($row->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url(route('member.transaction.show', ['id' => $row->id])) }}" class="btn-floating blue" style="opacity: 1;"><i class="material-icons" style="color: white;">subject</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('plugin_scripts')
<script src="{{ url('assets/master') }}/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/counter-up-master/jquery.counterup.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/chart.js/chart.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/flot/jquery.flot.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/flot/jquery.flot.time.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/curvedlines/curvedLines.js"></script>
<script src="{{ url('assets/master') }}/plugins/peity/jquery.peity.min.js"></script>
@endpush

@push('scripts')
<script src="{{ url('assets/master') }}/js/pages/dashboard.js"></script>
@endpush