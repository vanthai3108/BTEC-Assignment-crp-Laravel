@extends('adminlte::page')

@section('title', 'Admin | Course Statistics')

@section('content_header')
    <h1>User statics</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title">
                <i class="fas fa-fw fa-lg fa-chart-line"></i> 
                The chart compares the number of students at the institutions
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
                <div class="chart row justify-content-center">
                    <canvas id="myChart1" class="col-8"></canvas>
                </div>
            </div>
        </div>
        
        </div>
    </div>
    @php
    $dataLabels = [];
    $dataValues = [];
    $dataColors = [];
    foreach($users as $user) {
        if ($user->campus) {
            $dataLabels[] = $user->campus->name;
            $dataValues[] = $user->total;
            $dataColors[] = "rgba(".random_int(0, 255).", ".random_int(0, 255).",".random_int(0, 255).", 1)";
        } else if (!$user->campus && !in_array('Others', $dataLabels)) {
            $dataLabels[] = "Others";
            $dataValues[] = $user->total;
            $dataColors[] = "rgba(".random_int(0, 255).", ".random_int(0, 255).",".random_int(0, 255).", 1)";
        }
    }
    
    @endphp 
@stop

@section('css')

@stop

@section('js')
    <script>
        console.log('ok');
         // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        makeChart(
            "myChart1", 
            "doughnut", 
            {!! json_encode($dataLabels) !!}, 
            {!! json_encode($dataValues) !!}, 
            {!! json_encode($dataColors) !!}, 
        )
    </script>

@stop