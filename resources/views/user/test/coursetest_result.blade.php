@extends('layouts.app')

@section('title')
Course | Test results
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center text-center" style="height:80vh">
        <div class="col align-self-center">
            <h3>Test: {{$test->name}}</h3>
            <h5>You did it right: {{$result->result}}</h5>
            <a href="{{ route('my_course.show', $courseTest->course_id)}}" class="btn btn-primary col col-2">Go back</a>
        </div>
    </div>
</div>
@endsection