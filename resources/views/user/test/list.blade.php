@extends('layouts.app')

@section('title')
Test list
@endsection

@section('content')
<div class="container">
    @if (count($tests) == 0)
    <div class="row text-center mb-2">
        <h3 class="col-12">There is no Test to show</h3>
        <div class="row text-center mb-3">
            <a href="{{ route('tests.create') }}">Add new test</a>
        </div>
    </div>
    @else
    <div class="row text-center mb-2">
        <h3 class="col-12">My Tests</h3>
    </div>
    <div class="row text-center mb-3">
        <a href="{{ route('tests.create') }}">Add new test</a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col col-12">
            <table class="table table-striped projects">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $test)
                        <tr>
                            <td class="text-center align-middle">{{($tests->currentPage() - 1)  * $tests->perpage() + $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $test->name }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('tests.edit', $test->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $tests->links('vendor.pagination.custom-basic-admin', ['params' => $params]) }}
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection