@extends('adminlte::page')

@section('title', 'Admin | Edit course')

@section('content_header')
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info">Go Back</a>
   {{-- <h1>Edit campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit course: {{ $course->name }}</h3>
                      </div>
                    <form action="{{route('admin.courses.update', $course->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <select class="form-control" id="subject" name="subject_id">
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') != null ? (old('subject_id') == $subject->id ? 'selected' : '') 
                                        : ($course->subject_id == $subject->id ? 'selected' : '' )}}
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
                                        {{ old('class_id') != null ? (old('class_id') == $class->id ? 'selected' : '') 
                                        : ($course->class_id == $class->id ? 'selected' : '' )}}
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
                                        {{ old('semester_id') != null ? (old('semester_id') == $semester->id ? 'selected' : '') 
                                        : ($course->semester_id == $semester->id ? 'selected' : '' )}}
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
                                        {{ old('trainer_id') != null ? (old('trainer_id') == $trainer->id ? 'selected' : '') 
                                        : ($course->trainer_id == $trainer->id ? 'selected' : '' )}}
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
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1"
                                        {{ old('status') != null ? (old('status') == 1 ? 'selected' : '') 
                                        : ($course->status == 1 ? 'selected' : '' )}}
                                    >
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('status') != null ? (old('status') == 0 ? 'selected' : '') 
                                        : ($course->status == 0 ? 'selected' : '' )}}
                                    >
                                        Disable
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop