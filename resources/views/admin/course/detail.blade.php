@extends('adminlte::page')

@section('title', 'Admin | Course details')

@section('content_header')
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info">Go Back</a>
@stop
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title text-center">
                {{ $course->class->name }} - {{ $course->subject->name }}
                <span class="right badge badge-danger">{{ $course->semester->name }}</span>
                @if ($course->status)
                    <td class="align-middle text-center">
                        <span class="right badge badge-success">Active</span>
                    </td>
                @else
                    <td class="align-middle text-center">
                        <span class="right badge badge-danger">Disactive</span>
                    </td>
                @endif
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- <div class="card {{ $users->currentPage() != 1 ? '': 'collapsed-card'}}"> --}}
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Course members</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            {{-- @if($users->currentPage() != 1)
                                <i class="fas fa-minus"></i>
                            @else
                                <i class="fas fa-plus"></i>
                            @endif --}}
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;"
                {{-- @if ($users->currentPage() != 1)
                    style="display: block;"
                @else
                    style="display: none;"
                @endif --}}
                >
                    <table class="table table-striped projects">
                        <thead>
                            <tr style="background-color:#6c757d">
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Campus</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center align-middle">{{ ($users->currentPage() - 1)  * $users->perpage() + $loop->iteration }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle text-center">
                                        <img class="table-avatar" src="{{ config('app.url').'/'.$user->avatar }}" alt="avatar">
                                    </td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    @if ($user->campus)
                                        <td class="align-middle text-center">{{ $user->campus->name }}</td>
                                    @else
                                        <td class="align-middle text-red text-center"> - </td>
                                    @endif
                                    @if ($user->role)
                                        <td class="align-middle text-center">{{ $user->role->name }}</td>
                                    @else
                                        <td class="align-middle text-red text-center"> - </td>
                                    @endif
                                    @if ($user->status)
                                        <td class="align-middle text-center">
                                            <span class="right badge badge-success">Active</span>
                                        </td>
                                    @else
                                        <td class="align-middle text-center">
                                            <span class="right badge badge-danger">Disactive</span>
                                        </td>
                                    @endif
                                    <td class="text-center align-middle">
                                        <form id="deleteElement-{{$user->id}}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onClick="deleteAction(event, {{ $user->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm m-0 justify-content-center">
                        {{ $users->links('vendor.pagination.custom-basic') }}
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{-- {{ $course->users->links('vendor.pagination.custom-basic') }} --}}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop