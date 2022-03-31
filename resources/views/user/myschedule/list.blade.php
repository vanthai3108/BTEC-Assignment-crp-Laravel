@extends('layouts.app')

@section('title', 'Schedule')

@section('content_header')
    <h1>Schedules</h1>
@stop
@section('content')
<div class="container">
    @if (is_null($schedules) || count($schedules) == 0)
    <div class="row text-center mb-2">
        <h3 class="col-12">You have not taken any schedules</h3>
    </div>
    @else
        <div class="row text-center mb-2">
            <h3 class="col-12">My Schedules</h3>
        </div>
            <table class="table  table-striped projects">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Class</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Shift</th>
                        <th class="text-center">Location</th>
                        @if (Auth::user()->id == 2)
                            <th colspan="3" class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                    @php
                        $attendanceStatus = DB::table('schedule_user')->where('schedule_id', $schedule->id)->count();
                    @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ date('D - d/m/Y', strtotime($schedule->date)) }}</td>
                            <td class="align-middle text-center">{{ $schedule->course->class->name }}</td>
                            <td class="align-middle text-center">{{ $schedule->course->subject->name }}</td>
                            <td class="align-middle text-center">{{ $schedule->shift->name }}({{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }})</td>
                            <td class="align-middle text-center">{{ $schedule->location->room }} - {{ $schedule->location->building }}</td>
                            @if (Auth::user()->id == 2 && now()->format('Y-m-d') === $schedule->date)
                                @if ($attendanceStatus == 0)
                                    <td class="align-middle text-center">
                                        <a href="{{ route('my_schedule.attendance', $schedule->id) }}">Take attendance</a>
                                    </td>
                                @else
                                    <td class="align-middle text-center">
                                        <a href="{{ route('my_schedule.attendance_edit', $schedule->id) }}">Edit</a>
                                    </td>
                                @endif
                            @elseif(Auth::user()->id == 2)
                                <td class="align-middle text-center"><a>-</a></td>
                            @endif
                            {{-- <td class="align-middle text-center">{{ $schedule->semester->name }}</td> --}}
                            {{-- <td class="text-center align-middle"><a href="{{ route('my_course.show', $course->id) }}" class="btn btn-info"><i class="fas fa-lg fa-info-circle"></i> Details</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $schedules->links('vendor.pagination.custom-basic') }}
            </ul>
    @endif
</div>
@stop

@section('css')

@stop


@section('js')
    
@stop