@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets/backend') }}/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('assets/backend') }}/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')

    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Promotion</div>
            </div>
            @if (count($errors) > 0)
                <div class="col m12">
                    <div class="card-panel red lighten-1">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            {!! Form::open(['route' => 'backend.promotion.process', 'method' => 'post']) !!}
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="row">
                                <div class="col s4">
                                    {!! Form::label('status', 'Status') !!}
                                    {!! Form::select('status', [
                                                                        '0'=>'All Contact',
                                                                        '1'=>'All Member',
                                                                        '2'=>'All Subscriber'
                                                                    ], null) !!}

                                </div>
                            </div>
                            <div class="row">
                                <div class="col s8">
                                    {!! Form::label('promotions', 'Promotions') !!}
                                    {!! Form::textarea('promotions', null,['id'=>'promotions','rows'=>'5','maxlength'=>'160','required'=>true]) !!}
                                    Character <span id="p_char">0</span>/160
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    {!! Form::submit('Send',['class'=>'waves-effect waves-light btn']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <div class="col s12">
                <div class="page-title">Subscriber</div>
            </div>
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Phone Nuymber</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Phone Nuymber</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach($subscriber as $row)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url(route('backend.promotion.delete', ['id' => $row->id])) }}" class="btn-floating red" style="opacity: 1;"><i class="material-icons">clear</i></a>
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
    $("#promotions").keyup(function(){
        $("#p_char").text($(this).val().length);
    });
    @if (session('success'))
       $(document).ready(function () {
        swal("Success!", "{{ session('success') }}", "success");
    })
    @endif
</script>
@endpush