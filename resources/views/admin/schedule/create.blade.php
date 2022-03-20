@extends('adminlte::page')

@section('title', 'Admin | Create course')

@section('content_header')
    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info">Go Back</a>
    {{-- <h1>Add new campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new course</h3>
                    </div>
                    <form action="{{route('admin.schedules.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" value="{{$course->id}}" name="course_id">
                        <div class="form-group">
                            <label for="subject">Shift:</label>
                            <select class="form-control" id="shift" name="shift_id">
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"
                                        @if (old('shift_id') == $shift->id)
                                            selected
                                        @endif
                                    >
                                        {{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }})
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('shift_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('shift_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <select class="form-control" id="location" name="location_id">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        @if (old('location_id') == $location->id)
                                            selected
                                        @endif
                                    >
                                        {{ $location->room }} - {{ $location->building }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('location_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('location_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" 
                                id="date" name="date" value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </div>
                            @endif
                        </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info col col-12">Save</button>
                        </div>
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