@extends('adminlte::page')

@section('title', 'Admin | List users')

@section('content_header')
    <h1>List users</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.users.create') }}" class="text-success"><i class="fas fa-plus text-success"></i> Create new user</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Avatar</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Campus</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center align-middle">{{ ($users->currentPage() - 1)  * $users->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle text-center">
                                @if(!str_starts_with($user->avatar, 'http'))
                                    <img height="80px" src="{{ config('app.url').'/'.$user->avatar }}" alt="avatar">
                                @else
                                    <img height="80px" src="{{ $user->avatar }}" alt="avatar">
                                @endif
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
                            
                            @if(Auth::user()->id != $user->id || $user->role_id != 1)
                                <td class="text-center align-middle">
                                @if ($user->status)
                                    <a href="{{ route('admin.users.block', $user->id) }}" class="btn btn-secondary"><i class="fa fa-ban"></i> Block</a>
                                @else
                                    <a href="{{ route('admin.users.unblock', $user->id) }}" class="btn btn-secondary"><i class="fa fa-unlock-alt"></i> Unblock</a>
                                @endif
                                </td>
                            @else
                                <td class="text-center align-middle text-red"> - </td>
                            @endif
                            @if(Auth::user()->id != $user->id || $user->role_id != 1)
                            <td class="text-center align-middle"><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                            <td class="text-center align-middle">
                                <form id="deleteElement-{{$user->id}}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $user->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Delete</button>
                                </form>
                            </td>
                            @else
                                <td class="text-center align-middle text-red"> - </td>
                                <td class="text-center align-middle text-red"> - </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{ $users->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop