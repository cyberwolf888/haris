@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets/backend') }}/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('assets/backend') }}/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Product</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Manage Product</span>
                        <a class="waves-effect waves-light btn light-blue" href="{{ url(route('backend.product.create')) }}"><i class="material-icons left">open_in_new</i>Add New Data</a><br>
                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Available</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Available</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach($model as $row)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>Rp. {{ number_format($row->price,0,',','.') }}</td>
                                    <td>{{ $row->discount }} %</td>
                                    <td>{{ $row->available == 1 ? 'Yes':'No' }}</td>
                                    <td>
                                        <a href="{{ url(route('backend.product.show', ['id' => $row->id])) }}" class="btn-floating blue" style="opacity: 1;"><i class="material-icons">subject</i></a>
                                        <a href="{{ url(route('backend.product.edit', ['id' => $row->id])) }}" class="btn-floating orange" style="opacity: 1;"><i class="material-icons">mode_edit</i></a>
                                        <a href="{{ url(route('backend.product.gallery.manage', ['id' => $row->id])) }}" class="btn-floating green" style="opacity: 1;"><i class="material-icons">perm_media</i></a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
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
@endpush

@push('scripts')
<script src="{{ url('assets/backend') }}/js/pages/table-data.js"></script>
<script>
    @if (session('success'))
        $(document).ready(function () {
        swal("Success!", "{{ session('success') }}", "success");
    })
    @endif
</script>
@endpush