@extends('layouts.app')

@section('title')
Test | Add new
@endsection

@section('content')
<div class="container">
    <a href="{{ route('profile.index') }}" class="btn btn-info">Go Back</a>
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add new test</h3>
                </div>
                <form action="{{route('profile.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        
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