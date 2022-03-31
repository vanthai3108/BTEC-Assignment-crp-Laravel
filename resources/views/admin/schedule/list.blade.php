@extends('adminlte::page')

@section('title', 'Admin | List schedule')

@section('content_header')
    <h1>List schedules</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Schedule for {{ date('d/m/Y', strtotime($params['date'])) }}</h3>
            <form action="{{route('admin.schedules.index')}}" method="GET">
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
                    <div class="col-3">
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
                    <div class="col-3">
                        <label>Date:</label>
                        <div class="form-group">
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d', strtotime($params['date'])) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Filter</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <a href="{{route('admin.schedules.index')}}" class="btn btn-block btn-default">Clear</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Course</th>
                        <th class="text-center">Shift</th>
                        <th class="text-center">Location</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                    @php
                        $attendanceStatus = DB::table('schedule_user')->where('schedule_id', $schedule->id)->count();
                    @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $schedule->course->class->name }} - {{ $schedule->course->subject->name }}</td>
                            <td class="align-middle">{{ $schedule->shift->name }}</td>
                            <td class="align-middle">{{ $schedule->location->room }} - {{ $schedule->location->building }}</td>
                            {{-- <td class="align-middle">{{ date('d-m-Y',strtotime($schedule->date)) }}</td> --}}
                            
                            @if ($attendanceStatus == 0)
                                <td class="align-middle text-center bg-warning">
                                    <a href="{{ route('admin.schedules.attendance', $schedule->id) }}">Take attendance</a>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    <a href="{{ route('admin.schedules.attendance_edit', $schedule->id) }}">Edit</a>
                                </td>
                            @endif 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{-- {{ $schedules->links('vendor.pagination.custom-basic-admin', ['params' => $params]) }} --}}
            </ul>
        </div>
    </div>
@stop

@section('css')

@stop


@section('js')
    
@stop