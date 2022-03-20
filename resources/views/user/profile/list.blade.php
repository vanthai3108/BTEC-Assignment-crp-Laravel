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
                        @if (str_starts_with(Auth::user()->avatar, 'http'))
                            src="{{Auth::user()->avatar}}" alt="User profile picture">
                        @else
                            src="{{config('app.url')}}/{{Auth::user()->avatar}}" alt="User profile picture">
                        @endif
                    </div>
                    <h3 class="profile-username text-center">
                        @if(Auth::user()->name)
                            {{ Auth::user()->name }}
                        @endif
                    </h3>
                    <p class="text-muted text-center mb-0">
                        {{ Auth::user()->email }}
                    </p>
                    <div class="text-center">
                        <a href="{{ route('profile.edit_password') }}">Change password</a>
                    </div>
                    <form action="{{ route('profile.update_avatar', Auth::user()->id) }}" method="POST"
                        class="text-center mb-3" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-left">
                            <label for="avatar">Update avatar:</label>
                            <input type="file" class="form-control col-12" 
                                id="avatar" name="avatar">
                            
                        </div>
                        @if ($errors->has('avatar'))
                        <div class="form-group">
                                <div class="invalid-feedback" style="height: 100%">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </div>
                        </div>
                            @endif
                        <button type="submit" class="btn col col-4" style="background-color: #17a2b8">Update avatar</button>
                    </form>
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