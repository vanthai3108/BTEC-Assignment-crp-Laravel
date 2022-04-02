@extends('layouts.app')

@section('title', 'My courses')

@section('content_header')
    <h1>List courses</h1>
@stop
@section('content')
<div class="container">
    @if (is_null($courses) || count($courses) == 0)
    <div class="row text-center mb-2">
        <h3 class="col-12">You have not taken any courses yet</h3>
    </div>
    @else
        <div class="row text-center mb-2">
            <h3 class="col-12">My Courses</h3>
        </div>
            <table class="table  table-striped projects">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Class</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Semester</th>
                        @if(Auth::user()->role_id == 3)
                            <th class="text-center">Trainer</th>
                            <th class="text-center">Score</th>
                        @endif
                        <th class="text-center">Status</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="text-center align-middle">{{ ($courses->currentPage() - 1)  * $courses->perpage() + $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $course->class->name }}</td>
                            <td class="align-middle">{{ $course->subject->name }}</td>
                            <td class="align-middle text-center">{{ $course->semester->name }}</td>
                            @if(Auth::user()->role->name=='trainee')
                                <td class="align-middle">{{ $course->trainer->name }}</td>
                                <td class="align-middle text-center">
                                    @foreach ($course->users as $user)
                                        @if ($user->id == Auth::user()->id)
                                            @if ($user->pivot->score)
                                                {{ $user->pivot->score }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td class="align-middle text-center">
                                    @foreach ($course->users as $user)
                                        @if ($user->id == Auth::user()->id)
                                            @if ($user->pivot->status == 1)
                                                <span class="right badge bg-success">Passed</span>
                                            @elseif($user->pivot->score)
                                                <span class="right badge bg-danger">Failed</span>
                                            @else
                                                <span class="right badge bg-primary">Studing</span>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                            @if(Auth::user()->role_id == 2)
                                @if ($course->status)
                                    <td class="align-middle text-center">
                                        <span class="right badge badge-success">Active</span>
                                    </td>
                                @else
                                    <td class="align-middle text-center">
                                        <span class="right badge badge-danger">Disactive</span>
                                    </td>
                                @endif
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('my_course.show', $course->id) }}" class="btn btn-primary"><i class="fas fa-lg fa-info-circle"></i> Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $courses->links('vendor.pagination.custom-basic') }}
            </ul>
    @endif
</div>
@stop

@section('css')

@stop


@section('js')
    
@stop