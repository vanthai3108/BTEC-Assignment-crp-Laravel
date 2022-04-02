@extends('adminlte::page')

@section('title', 'Admin | List users')

@section('content_header')
    <h1>List users</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.users.create') }}" class="text-success">
                    <i class="fas fa-plus text-success"></i> Create new user
                </a>
            </h3>
            <form action="{{route('admin.users.index')}}" method="GET">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Role:</label>
                            <select class="form-control" style="width: 100%;" name="role_id">
                                <option value="">All</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}"
                                        @if(isset($params['role_id']) && $params['role_id'] == $role->id) selected @endif>
                                        {{ucfirst($role->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Campus:</label>
                            <select class="form-control" style="width: 100%;" name="campus_id">
                                <option value="">All</option>
                                @foreach($campuses as $campus)
                                    <option value="{{$campus->id}}" 
                                        @if(isset($params['campus_id']) && $params['campus_id'] == $campus->id) selected @endif>
                                        {{ucfirst($campus->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-control" style="width: 100%;" name="status">
                                <option value="">All</option>
                                <option value="1" @if(isset($params['status']) && $params['status'] == 1) selected @endif>
                                    Active
                                </option>
                                <option value="0" @if(isset($params['status']) && $params['status'] == 0) selected @endif>
                                    Inactive
                                </option>
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
                    <div class="col-2  mt-2 p-0">
                        <div class="form-group mb-0 pt-4">
                            <a href="{{route('admin.users.index')}}" class="btn btn-block btn-default ms-auto">Clear</a>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="input-group col-8">
                        <input type="search" name="keyword" class="form-control" placeholder="Type your keywords here" 
                                value="@if(isset($params['keyword'])){{$params['keyword']}}@endif">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
                                    <span class="right badge badge-danger">Inactive</span>
                                </td>
                            @endif
                            
                            @if(Auth::user()->id != $user->id || $user->role->name != 'admin')
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
                            @if(Auth::user()->id != $user->id || $user->role->name != 'admin')
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
                {{-- {{ dd($users->links())}} --}}
                {{ $users->links('vendor.pagination.custom-basic-admin', ['params' => $params]) }}
            </ul>
        </div>
    </div>
@stop

@section('css')

@stop


@section('js')

@stop