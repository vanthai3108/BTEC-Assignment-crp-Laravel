@extends('adminlte::page')

@section('title', 'Admin | List subjects')

@section('content_header')
    <h1>List subject</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.subjects.create') }}" class="text-success"><i class="fas fa-plus text-success"></i> Create new subject</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Sessions</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td class="text-center align-middle">{{ ($subjects->currentPage() - 1)  * $subjects->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $subject->code }}</td>
                            <td class="align-middle">{{ $subject->name }}</td>
                            <td class="align-middle">{{ $subject->sessions }}</td>
                            <td class="align-middle">{{ $subject->category->name}}</td>
                            @if ($subject->status)
                                <td class="align-middle text-center">
                                    <span class="right badge badge-success">Active</span>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    <span class="right badge badge-danger">Disactive</span>
                                </td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                            <td class="text-center align-middle">
                                <form id="deleteElement-{{$subject->id}}" action="{{ route('admin.subjects.destroy',$subject->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $subject->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $subjects->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop
