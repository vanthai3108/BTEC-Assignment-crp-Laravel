@extends('adminlte::page')

@section('title', 'Admin | List courses')

@section('content_header')
    <h1>List courses</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.courses.create') }}" class="text-success"><i class="fas fa-plus text-success"></i> Create new course</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Class</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Trainer</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Status</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="text-center align-middle">{{ ($courses->currentPage() - 1)  * $courses->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $course->class->name }}</td>
                            <td class="align-middle">{{ $course->subject->name }}</td>
                            <td class="align-middle">{{ $course->trainer->name }}</td>
                            <td class="align-middle">{{ $course->semester->name }}</td>
                            @if ($course->status)
                                <td class="align-middle text-center">
                                    <span class="right badge badge-success">Active</span>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    <span class="right badge badge-danger">Disactive</span>
                                </td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info"><i class="fas fa-lg fa-info-circle"></i> Details</a></td>
                            <td class="text-center align-middle"><a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                            <td class="text-center align-middle">
                                <form id="deleteElement-{{$course->id}}" action="{{ route('admin.courses.destroy',$course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $course->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Delete</button>
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
                {{ $courses->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop