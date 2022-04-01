@extends('adminlte::page')

@section('title', 'Admin | Course Statistics')

@section('content_header')
    <h1>Course statics</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title">
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.courses.static')}}" method="GET">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Class:</label>
                            <select class="form-control" style="width: 100%;" name="class_id">
                                <option value="">All</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}"
                                        @if(isset($params['class_id']) && $params['class_id'] == $class->id) selected @endif>
                                        {{ucfirst($class->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Subject:</label>
                            <select class="form-control" style="width: 100%;" name="subject_id">
                                <option value="">All</option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}"
                                        @if(isset($params['subject_id']) && $params['subject_id'] == $subject->id) selected @endif>
                                        {{ucfirst($subject->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Semester:</label>
                            <select class="form-control" style="width: 100%;" name="semester_id">
                                <option value="">All</option>
                                @foreach($semesters as $semester)
                                    <option value="{{$semester->id}}"
                                        @if(isset($params['semester_id']) && $params['semester_id'] == $semester->id) selected @endif>
                                        {{ucfirst($semester->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Quantity:</label>
                            <select class="form-control" style="width: 100%;" name="limit">
                                <option value="10" @if($params['limit'] == 10) selected @endif>10</option>
                                <option value="20" @if($params['limit'] == 20) selected @endif>20</option>
                                <option value="50" @if($params['limit'] == 50) selected @endif>50</option>
                                <option value="100" @if($params['limit'] == 100) selected @endif>100</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="input-group col-8">
                        <input type="search" name="keyword" class="form-control" placeholder="Type your keywords here" 
                                value="@if(isset($params['keyword'])){{$params['keyword']}}@endif">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info" style="height:70%">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <a href="{{route('admin.courses.static')}}" class="btn btn-block btn-default">Clear</a>
                        </div>
                    </div>
                </div>
            </form>
        <div class="box box-primary">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Class</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Score</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userGrades as $userGrade)
                        <tr>
                            <td class="text-center align-middle">{{ ($userGrades->currentPage() - 1)  * $userGrades->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $userGrade->email }}</td>
                            <td class="align-middle">{{ $userGrade->user_name }}</td>
                            <td class="align-middle">{{ $userGrade->class_name }}</td>
                            <td class="align-middle">{{ $userGrade->subject_name }}</td>
                            <td class="align-middle">{{ $userGrade->semester_name }}</td>
                            @if ($userGrade->score)
                                <td class="align-middle text-center">{{ $userGrade->score }}</td>
                            @else
                                <td class="align-middle text-center"> - </td>
                            @endif
                            {{-- <td class="align-middle">{{ $course->subject->name }}</td>
                            <td class="align-middle">{{ $course->trainer->name }}</td>
                            <td class="align-middle">{{ $course->semester->name }}</td> --}}
                            @if ($userGrade->status)
                                <td class="align-middle text-center">
                                    <span class="right badge badge-success">Passed</span>
                                </td>
                            @elseif(is_null($userGrade->status))
                                <td class="align-middle text-center">
                                    <span class="right badge">-</span>
                                </td>
                            @else 
                                <td class="align-middle text-center">
                                    <span class="right badge badge-danger">Failed</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $userGrades->links('vendor.pagination.custom-basic-admin', ['params' => $params]) }}
            </ul>
        </div>
    </div>

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
                    <canvas id="myChart2" class="col-8"></canvas>
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

        makeChart(
            "myChart2", 
            "doughnut", 
            {!! json_encode($dataLabels) !!}, 
            {!! json_encode($dataValues) !!}, 
            {!! json_encode($dataColors) !!}, 
        )
    </script>
@stop