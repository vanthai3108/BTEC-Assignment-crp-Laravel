@extends('adminlte::page')

@section('title', 'Admin | List locations')

@section('content_header')
    <h1>List locations</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.locations.create') }}" class="text-success"><i class="fas fa-plus text-success"></i> Create new location</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Room</th>
                        <th class="text-center">Building</th>
                        <th class="text-center">Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td class="text-center align-middle">{{ ($locations->currentPage() - 1)  * $locations->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $location->room }}</td>
                            <td class="align-middle">{{ $location->building }}</td>
                            @if ($location->status)
                                <td class="align-middle text-center">
                                    <span class="right badge badge-success">Active</span>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    <span class="right badge badge-danger">Disactive</span>
                                </td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                            <td class="text-center align-middle">
                                <form id="deleteElement-{{$location->id}}" action="{{ route('admin.locations.destroy',$location->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $location->id }})" class="btn btn-danger"><i class="fas fa-trash text-white"></i> Delete</button>
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
                {{ $locations->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop
