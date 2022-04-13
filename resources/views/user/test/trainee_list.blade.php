@extends('layouts.app')

@section('title')
Test list
@endsection

@section('content')
<div class="container">
    <div class="row text-center mb-2">
        <h3 class="col-12">My Tests</h3>
    </div>
    <form action="{{route('tests.index')}}" method="GET">
        <div class="row justify-content-end">
            <div class="col-2">
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" style="width: 100%;" name="status">
                        <option value="0">All</option>
                        <option value="1" @if(isset($params['status']) && $params['status'] == 1) selected @endif>In progress</option>
                        <option value="2" @if(isset($params['status']) && $params['status'] == 2) selected @endif>Not started yet</option>
                        <option value="3" @if(isset($params['status']) && $params['status'] == 3) selected @endif>Finished</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Quantity:</label>
                    <select class="form-control" style="width: 100%;" name="limit">
                        <option value="5" @if($params['limit'] == 5) selected @endif>5</option>
                        <option value="10" @if($params['limit'] == 10) selected @endif>10</option>
                        <option value="50" @if($params['limit'] == 50) selected @endif>50</option>
                        <option value="100" @if($params['limit'] == 100) selected @endif>100</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <label>Search:</label>
                <div class="input-group col-12">
                    <input type="search" name="keyword" class="form-control" placeholder="Type your keywords here" 
                            value="@if(isset($params['keyword'])){{$params['keyword']}}@endif">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info m-0 pl-3 pr-3">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-2 mt-2">
                <div class="form-group m-0 pt-4">
                    <a href="{{route('tests.index')}}" class="btn btn-block btn-secondary m-0">Clear</a>
                </div>
            </div>
        </div>
    </form>
    <div class="row justify-content-center">
        <div class="col col-12">
            @if (count($tests) == 0)
                <div class="row text-center mb-2">
                    <h3 class="col-12">There is no Test to show</h3>
                </div>
            @else
            <table class="table table-striped projects">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Course</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Time</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $test)
                        <tr>
                            <td class="text-center align-middle">{{ ($tests->currentPage() - 1)  * $tests->perpage() + $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $test->test->name }}</td>
                            <td class="align-middle text-center">
                                @if($test->course)
                                {{ $test->course->class->name }} - {{ $test->course->subject->name }}
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                {{ date('d/m/Y', strtotime($test->date)) }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $test->start_time }} - {{ $test->end_time }}
                            </td>
                            @php
                                    $check = DB::table('test_user')->where([
                                        'user_id' => Auth::user()->id,
                                        'test_course_id' => $test->id
                                    ])->count();
                            @endphp
                            @if($test->date > now()->format('Y-m-d') || ($test->date == now()->format('Y-m-d') && now()->format('H:i:s') <= $test->end_time && now()->format('H:i:s') <= $test->start_time))
                                <td class="align-middle text-center text-success">
                                    Not started yet
                                </td>
                            @elseif($test->date == now()->format('Y-m-d') && now()->format('H:i:s') >= $test->start_time && now()->format('H:i:s') <= $test->end_time)
                            <td class="align-middle text-center text-success">
                                
                                @if($check > 0)
                                    <a href="{{ route('my_course.course_test_result', $test->id)}}">View result</a>
                                @else
                                    <a href="{{ route('my_course.course_test', $test->id)}}">Take the test</a>
                                @endif
                            </td>
                            @else
                                <td class="align-middle text-center text-danger">
                                    @if($check > 0)
                                        <a href="{{ route('my_course.course_test_result', $test->id)}}">View result</a>
                                    @else
                                        <a>Missed</a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- @endif --}}
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $tests->links('vendor.pagination.custom-basic-admin', ['params' => $params]) }}
            </ul>
            @endif
        </div>
    </div>
    
</div>
@endsection
