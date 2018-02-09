@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets/master') }}/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('assets/master') }}/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Transaction</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Manage Transaction</span>
                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($model as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->fullname }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ 'Rp '.number_format($row->total,0,',','.') }}</td>
                                    <td>{{ $row->getStatus($row->status) }}</td>
                                    <td>{{ date("d M Y, H:i",strtotime($row->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url(route('backend.transaction.show', ['id' => $row->id])) }}" class="btn-floating blue" style="opacity: 1;"><i class="material-icons">subject</i></a>
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
<script src="{{ url('assets/master') }}/plugins/sweetalert/sweetalert.min.js"></script>
<script src="{{ url('assets/master') }}/plugins/datatables/js/jquery.dataTables.min.js"></script>
@endpush

@push('scripts')
<script src="{{ url('assets/master') }}/js/pages/table-data.js"></script>
<script>
    @if (session('success'))
        $(document).ready(function () {
        swal("Success!", "{{ session('success') }}", "success");
    })
    @endif
</script>
@endpush