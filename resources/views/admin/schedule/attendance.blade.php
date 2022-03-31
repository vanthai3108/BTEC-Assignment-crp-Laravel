@extends('adminlte::page')

@section('title', 'Schedule | Attendance')

@section('content_header')
    <h1>Take attendance</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12">
            <div class="mb-4">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-info">Go Back</a>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Attendance: 
                        {{ $schedule->course->class->name }} - {{ $schedule->course->subject->name }}
                        ({{ date('D - d/m/Y', strtotime($schedule->date)) }})
                    </h3>
                </div>
                <form action="{{route('admin.schedules.attendance_handle', $schedule->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table class="table  table-striped projects">
                            <thead>
                                <tr style="background-color:#00a4c5e0;">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th colspan="2" class="text-center">Status</th>
                                    <th class="text-center">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
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
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input value="1" class="custom-control-input" type="radio" id="status{{$user->id}}-1" name="user{{$user->id}}" required>
                                                <label for="status{{$user->id}}-1" class="custom-control-label text-success">Present</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input value="0" class="custom-control-input" type="radio" id="status{{$user->id}}-2" name="user{{$user->id}}" required>
                                                <label for="status{{$user->id}}-2" class="custom-control-label text-danger">Absent</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="note{{$user->id}}" placeholder="Note...">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info col col-12">Save</button>
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