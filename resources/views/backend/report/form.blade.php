@extends('layouts.backend')

@push('plugin_css')
@endpush

@section('content')
    {!! Form::open(['route' => 'backend.report.transaction', 'method' => 'post']) !!}
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Report</div>
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
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="row">
                                <div class=" col s4">
                                    {!! Form::label('start_date', 'Start Date', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                    {!! Form::text('start_date',null,['class'=>'datepicker','required'=>'true']) !!}
                                </div>
                                <div class=" col s4">
                                    {!! Form::label('end_date', 'End Date', ['data-error' => 'wrong','data-success'=>'right']) !!}
                                    {!! Form::text('end_date',null,['class'=>'datepicker','required'=>'true']) !!}
                                </div>
                                <div class="col s4">
                                    {!! Form::label('status', 'Status') !!}
                                    {!! Form::select('status', [
                                                                        '6'=>'All Status',
                                                                        '4'=>'Complete Order'
                                                                    ], null) !!}

                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    {!! Form::submit('Search',['class'=>'waves-effect waves-light btn light-blue']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {!! Form::close() !!}
@endsection

@push('plugin_scripts')
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year
            closeOnSelect: true,
            format: 'd mmmm, yyyy',
        });
    });
</script>
@endpush