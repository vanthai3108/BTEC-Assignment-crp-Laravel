@extends('adminlte::page')

@section('title', 'Admin | List shifts')

@section('content_header')
    <h1>List shift</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.shifts.create') }}" class="text-success">
                    <i class="fas fa-plus text-success"></i> Create new shift
                </a>
            </h3>
            <form action="{{route('admin.shifts.index')}}" method="GET">
                <div class="row justify-content-end">
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
                    <div class="col-2 mt-2">
                        <div class="form-group mb-0 pt-4">
                            <a href="{{route('admin.classes.index')}}" class="btn btn-block btn-default">Clear</a>
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
                        <th class="text-center">Start Time</th>
                        <th class="text-center">End Time</th>
                        <th class="text-center">Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shifts as $shift)
                        <tr>
                            <td class="text-center align-middle">{{ ($shifts->currentPage() - 1)  * $shifts->perpage() + $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $shift->name }}</td>
                            <td class="align-middle text-center">{{ $shift->start_time }}</td>
                            <td class="align-middle text-center">{{ $shift->end_time }}</td>
                            @if ($shift->status)
                                <td class="align-middle text-center">
                                    <span class="right badge badge-success">Active</span>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    <span class="right badge badge-danger">Disactive</span>
                                </td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('admin.shifts.edit', $shift->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                            <td class="text-center align-middle">
                                <form id="deleteElement-{{$shift->id}}" action="{{ route('admin.shifts.destroy',$shift->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $shift->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Delete</button>
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
                {{ $shifts->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop
