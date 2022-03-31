@extends('layouts.app')

@section('title', 'Test | Results')

@section('content_header')
    {{-- <h1>Courses</h1> --}}
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12">
            <div class="card card-info">
                <div class="card-header justify-content-between">
                    <h3 class="card-title col-6">Course: 
                        {{ $courseTest->course->class->name }} - {{ $courseTest->course->subject->name }}
                    </h3>
                    <h3 class="card-title col-6 text-right">Test: 
                        {{ $courseTest->test->name }}
                    </h3>
                </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class="btn btn-primary" href="{{route('my_course.show', $courseTest->course->id)}}">Go Back</a>
                        </div>
                        <table class="table  table-striped projects">
                            <thead>
                                <tr style="background-color:#00a4c5e0;">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Result</th>
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
                                        <td class="align-middle text-center">
                                            @php $check = false @endphp
                                            @foreach($courseTest->users as $testUser) 
                                            @if($testUser->id == $user->id)
                                                {{$testUser->pivot->result}}
                                                @php $check = true @endphp
                                                @break
                                            @endif
                                            @endforeach
                                            @if (!$check)
                                                @if($courseTest->date < now()->format('Y-m-d') ||($courseTest->date == now()->format('Y-m-d') && now()->format('H:i:s') >= $courseTest->end_time))
                                                    <label class="text-danger">Missed</label>
                                                @else
                                                    <label class="text-warning">Haven't done yet</label>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
            </div>                
        </div>
    </div> 
</div>
@stop

@section('css')

@stop


@section('js')
    
@stop