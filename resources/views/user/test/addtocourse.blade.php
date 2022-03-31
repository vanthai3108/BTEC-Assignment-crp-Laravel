@extends('layouts.app')

@section('title')
Course | Add test
@endsection

@section('content')
<div class="container">
    <a href="{{ route('my_course.show', $course->id) }}" class="btn btn-info">Go Back</a>
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add test to course: {{$course->class->name}} - {{$course->subject->name}}</h3>
                </div>
                <form action="{{route('my_course.add_test')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{$course->id}}" name="course_id">
                        <div class="form-group">
                            <label for="test">Test:</label>
                            <select class="form-control" id="test" name="test_id">
                                @foreach ($tests as $test)
                                    <option value="{{ $test->id }}"
                                        @if (old('test_id') == $test->id)
                                            selected
                                        @endif
                                    >
                                        {{ $test->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('test_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('test_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" id="datemul" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" 
                                id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" multiple>
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="start_time">Start time:</label>
                            <input type="time" class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}" 
                                id="start_time" name="start_time" value="{{ old('start_time') ? old('start_time') : "00:00" }}" >
                            @if ($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('start_time') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="end_time">End time:</label>
                            <input type="time" class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}" 
                                id="end_time" name="end_time" value="{{ old('end_time') ? old('end_time') : "00:00" }}" >
                            @if ($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('end_time') }}</strong>
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="key">Infomation key:</label>
                            <input type="text" class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" 
                                id="key" name="key" value="{{ old('key') }}" placeholder="Enter infomation key">
                            @if ($errors->has('key'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('key') }}</strong>
                                </div>
                            @endif
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn col col-12" style="background-color: #17a2b8">Save</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection