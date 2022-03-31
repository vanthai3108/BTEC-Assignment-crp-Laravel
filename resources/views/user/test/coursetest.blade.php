@extends('layouts.app')

@section('title')
Course | Test
@endsection

@section('content')
@php
    $date = date('F d, Y ', strtotime($courseTest->date));
    $dateTime = $date . $courseTest->end_time;
    // var_dump($date);
@endphp
<div class="container">

    <div class="row justify-content-center">
        <div class="col col-10">
            <div class="card card-info">
                <div class="card-header text-center">
                    <h3 class="card-title card-title">Test: {{$test->name}}</h3>
                    <h4 class="card-title card-tools" id="time"></h4>
                </div>
                <form id="submit-test" action="{{route('my_course.course_test_submit', $courseTest->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{$courseTest->test_id}}" name="test_id">
                        @foreach($questions as $question)
                            @php $question['content'] = json_decode($question['content']) @endphp
                            <div class="form-group">
                                <label>Quesstion {{ $loop->iteration++ }}: {{ $question->content->title }}</label>
                                @for($i = 0; $i < count($question->content->answers); $i++)
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="{{$question->content->answers[$i]}}" type="radio" name="question-{{$question->id}}" id="question-{{$question->id}}-{{$i}}">
                                    <label class="custom-control-label" style="font-weight:500" for="question-{{$question->id}}-{{$i}}">{{$i+1}}. {{ $question->content->answers[$i] }}</label>
                                </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn col col-12" style="background-color: #17a2b8">Submit</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

function checkTime(dateTime) {
    var now = new Date().getTime();
    var end_time = new Date(dateTime).getTime();
    var distance = end_time - now;
    if (now >= end_time) {
        document.getElementById("submit-test").submit();
    } else {
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (hours > 0) {
            document.getElementById("time").innerHTML = "Remaining: " + hours + "h "+ minutes + "m " + seconds + "s ";
        } else if (hours <= 0 && minutes > 0) {
            document.getElementById("time").innerHTML = "Remaining: " + minutes + "m " + seconds + "s ";
        } else {
            document.getElementById("time").innerHTML = "Remaining: " + seconds + "s ";
        }
    }
}

setInterval(function() {checkTime("{{$dateTime}}");}, 1000);
</script>
@stop