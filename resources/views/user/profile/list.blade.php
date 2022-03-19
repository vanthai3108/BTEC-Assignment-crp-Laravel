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
                        @if(Auth::user()->name)
                            {{ Auth::user()->name }}
                        @endif
                    </h3>
                    <p class="text-muted text-center">
                            {{ Auth::user()->email }}
                    </p>
                    <div class="text-center mb-3">
                        <a class="text-warning" href="{{route('profile.edit_user')}}">
                            <i class="fas fa-pen text-warning"></i> Edit
                        </a>
                    </div>
                    <div>
                        <h4>Other information:</h4>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach ($profiles as $profile)
                            <form action="{{ route('profile.destroy',$profile->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="list-group-item mb-2">
                                    <b>{{$profile->key}}: </b>{{$profile->value}}
                                    <button type="submit" class="close">×</button>
                                    <a class="float-right mr-3" href="{{ route('profile.edit', $profile->id)}}">
                                        <i class="fas fa-pen text-warning"></i>
                                    </a>
                                </li>
                            </form>
                        @endforeach
                    </ul>
                    <a href="{{ route('profile.create')}}" class="btn btn-block" style="background-color:#17a2b8"><b>Add new</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection