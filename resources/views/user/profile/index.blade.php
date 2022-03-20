@extends('layouts.app')

@section('title')
Profile
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-info card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="avatar rounded-circle img-thumbnail" style="height: 150px; width:150px;" 
                            src="{{config('app.url')}}/{{Auth::user()->avatar}}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">
                        @if($user->name)
                            {{ $user->name }}
                        @endif
                    </h3>
                    <p class="text-muted text-center">
                            {{ $user->email }}
                    </p>
                    <div>
                        <h4>Other information:</h4>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach ($profiles as $profile)
                        <form action="">
                            <li class="list-group-item mb-2">
                                <b>{{$profile->key}}: </b>{{$profile->value}}
                            </li>
                        </form>
                        @endforeach
                    </ul>
                    <div>
                        <h4>Courses:</h4>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach ($courses as $course)
                        <form action="">
                            <li class="list-group-item mb-2">
                                <b>{{$course->class->name}} - {{$course->subject->name}}</b>
                                    <span class="right badge badge-danger">{{ $course->semester->name }}</span>
                                @if($user->role_id == 3)
                                    <span class="right badge badge-primary"> Trainer: {{ $course->trainer->name }}</span>
                                @endif
                                @foreach ($course->users as $courseUser)
                                    @if ($courseUser->id == $user->id)
                                        @if ($courseUser->pivot->status == 1)
                                            <span class="right badge bg-success">Passed</span>
                                        @elseif($courseUser->pivot->score)
                                            <span class="right badge bg-danger">Failed</span>
                                        @else
                                            <span class="right badge bg-info">Studing</span> 
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                        </form>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection