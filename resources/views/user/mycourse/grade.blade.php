@extends('layouts.app')

@section('title', 'Course | Grading')

@section('content_header')
    <h1>Courses</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Course: 
                        {{ $course->class->name }} - {{ $course->subject->name }}
                    </h3>
                </div>
                <form action="{{route('my_course.grade', $course->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <a class="btn btn-primary" href="{{route('my_course.show', $course->id)}}">Go Back</a>
                        </div>
                        <table class="table  table-striped projects">
                            <thead>
                                <tr style="background-color:#00a4c5e0;">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Status</th>
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
                                            <input type="number" min="0" max="100" class="form-control" name="score{{$user->id}}" placeholder="Enter scores"
                                            @foreach ($user->courses as $userCourse)
                                                @if($course->id == $userCourse->pivot->course_id)
                                                {{-- {{ dd($userCourse->pivot) }} --}}
                                                    @if ($userCourse->pivot->score)
                                                        value="{{ $userCourse->pivot->score }}"
                                                    @endif
                                                @endif
                                            @endforeach
                                            required>
                                        </td>
                                        <td class="align-middle text-center">
                                            @foreach ($course->users as $userCourse)
                                                @if ($userCourse->pivot->user_id == $user->id)
                                                    @if ($userCourse->pivot->status == 1)
                                                        <span class="right badge bg-success">Passed</span>
                                                    @elseif($userCourse->pivot->score)
                                                        <span class="right badge bg-danger">Failed</span>
                                                    @else
                                                        - 
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary col col-12">Save</button>
                    </div>
                </form>
            </div>                
        </div>
    </div> 
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop