@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets/backend') }}/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('assets/backend') }}/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ url('assets/backend') }}/datatables/buttons.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Report Transaction</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Report Periode {{ date('d F Y',strtotime($start_date)) }} - {{ date('d F Y',strtotime($end_date)) }}</span>
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
<script src="{{ url('assets/backend') }}/plugins/sweetalert/sweetalert.min.js"></script>
<script src="{{ url('assets/backend') }}/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ url('assets/backend') }}/datatables/dataTables.buttons.min.js"></script>
<script src="{{ url('assets/backend') }}/datatables/jszip.min.js"></script>
<script src="{{ url('assets/backend') }}/datatables/pdfmake.min.js"></script>
<script src="{{ url('assets/backend') }}/datatables/vfs_fonts.js"></script>
<script src="{{ url('assets/backend') }}/datatables/buttons.html5.min.js"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                searchPlaceholder: 'Search records',
                sSearch: '',
                sLengthMenu: 'Show _MENU_',
                sLength: 'dataTables_length',
                oPaginate: {
                    sFirst: '<i class="material-icons">chevron_left</i>',
                    sPrevious: '<i class="material-icons">chevron_left</i>',
                    sNext: '<i class="material-icons">chevron_right</i>',
                    sLast: '<i class="material-icons">chevron_right</i>'
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                }
            ]
        });
        $('.dataTables_length select').addClass('browser-default');
    });

    @if (session('success'))
        $(document).ready(function () {
        swal("Success!", "{{ session('success') }}", "success");
    })
    @endif
</script>
@endpush