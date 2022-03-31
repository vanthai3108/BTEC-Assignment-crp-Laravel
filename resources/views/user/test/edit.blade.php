@extends('layouts.app')

@section('title')
Test | Edit
@endsection

@section('content')
<div class="container">
    <a href="{{ route('tests.index') }}" class="btn btn-info mb-4">Go Back</a>
    <div class="row justify-content-center">
        <div class="col col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit test: {{$test->name}}</h3>
                </div>
                <form action="{{route('tests.update', $test->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Test name:</label>
                            <input type="text" class="form-control" 
                                    id="name" name="name" value="{{$test->name}}" placeholder="Enter test name" required>
                        </div>
                        <test-component></test-component>
                    </div>
                    {{-- <div class="card-body">
                        
                    </div> --}}
                    <div class="card-footer">
                        <button type="submit" class="btn col col-12" style="background-color: #17a2b8">Save</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection