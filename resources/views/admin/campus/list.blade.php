@extends('adminlte::page')

@section('title', 'Admin | List campuses')

@section('content_header')
    <h1>List campuses</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.campuses.create') }}" class="text-info"><i class="fas fa-plus text-info"></i> Create new campus</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campuses as $campus)
                        <tr>
                            <td class="text-center align-middle">{{ ($campuses->currentPage() - 1)  * $campuses->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $campus->name }}</td>
                            <td class="text-center align-middle"><a href="{{ route('admin.campuses.edit', $campus->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form id="deleteElement-{{$campus->id}}" action="{{ route('admin.campuses.destroy',$campus->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $campus->id }})" class="btn btn-block"><i class="fas fa-trash text-red"></i></button>
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
                {{ $campuses->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop
