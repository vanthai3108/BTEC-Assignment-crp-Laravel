@extends('adminlte::page')

@section('title', 'Admin | Create course')

@section('content_header')
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info">Go Back</a>
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
                    <form action="{{route('admin.courses.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <select class="form-control" id="role" name="subject_id">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        @if (old('subject_id') == $subject->id)
                                            selected
                                        @endif
                                    >
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('subject_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="class">Class:</label>
                            <select class="form-control" id="class" name="class_id">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        @if (old('class_id') == $class->id)
                                            selected
                                        @endif
                                    >
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('class_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('class_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester:</label>
                            <select class="form-control" id="semester" name="semester_id">
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}"
                                        @if (old('semester_id') == $semester->id)
                                            selected
                                        @endif
                                    >
                                        {{ $semester->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('semester_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('semester_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="trainer">Trainer:</label>
                            <select class="form-control" id="trainer" name="trainer_id">
                                @foreach ($trainers as $trainer)
                                    <option value="{{ $trainer->id }}"
                                        @if (old('trainer_id') == $trainer->id)
                                            selected
                                        @endif
                                    >
                                        {{ $trainer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('trainer_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('trainer_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start date:</label>
                            <input type="date" id="datemul" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" 
                                id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" multiple>
                            @if ($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="end_date">End date:</label>
                            <input type="date" id="datemul" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" 
                                id="end_date" name="end_date" value="{{ old('end_date', date('Y-m-d')) }}" multiple>
                            @if ($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </div>
                            @endif
                        </div>
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