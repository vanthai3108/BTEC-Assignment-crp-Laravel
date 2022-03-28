@extends('layouts.app')

@section('title', 'Schedule | Attendance - Edit')

@section('content_header')
    <h1>Schedules</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12">
            <div class="mb-3">
                <a href="{{ route('my_course.show', $attendance->course->id) }}" class="btn btn-primary">Go back</a>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Attendance: 
                        {{ $attendance->course->class->name }} - {{ $attendance->course->subject->name }}
                        ({{ date('D - d/m/Y', strtotime($attendance->date)) }})
                    </h3>
                </div>
                <form action="{{route('my_schedule.attendance_edit_handle', $attendance->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table class="table  table-striped projects">
                            <thead>
                                <tr style="background-color:#00a4c5e0;">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance->users as $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-center">
                                            @if(!str_starts_with($user->avatar, 'http'))
                                                <img class="table-avatar" src="{{ config('app.url').'/'.$user->avatar }}" alt="avatar">
                                            @else
                                                <img class="table-avatar" src="{{ $user->avatar }}" alt="avatar">
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">{{ $user->name }}</td>
                                        <td class="align-middle text-center">{{ $user->code }}</td>
                                        <td class="align-middle text-center">
                                            @if($user->pivot->status) 
                                                <label class="text-success">Present</label> 
                                            @else
                                                <label class="text-danger">Absent</label> 
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($user->pivot->note)
                                                {{$user->pivot->note}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{-- <button type="submit" class="btn btn-info col col-12">Save</button> --}}
                    </div>
                </form>
            </div>                
        </div>
    </div> 
</div>
@stop

@section('css')

@stop


@section('js')
    
@stop