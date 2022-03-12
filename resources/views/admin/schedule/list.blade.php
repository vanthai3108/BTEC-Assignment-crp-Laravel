@extends('adminlte::page')

@section('title', 'Admin | List schedule')

@section('content_header')
    <h1>List schedules</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.schedules.create') }}" class="text-success"><i class="fas fa-plus text-success"></i> Create new sheldule</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#00a4c5e0;">
                        <th class="text-center">#</th>
                        <th class="text-center">Course</th>
                        <th class="text-center">Shift</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Date</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td class="text-center align-middle">{{ ($schedules->currentPage() - 1)  * $schedules->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $schedule->course->class->name }} - {{ $schedule->course->subject->name }}</td>
                            <td class="align-middle">{{ $schedule->shift->name }}</td>
                            <td class="align-middle">{{ $schedule->location->room }} - {{ $schedule->location->building }}</td>
                            <td class="align-middle">{{ date('d-m-Y',strtotime($schedule->date)) }}</td>
                            <td class="text-center align-middle"><a href="{{ route('admin.schedules.show', $schedule->id) }}"><i class="fas fa-lg fa-info-circle text-info"></i></a></td>
                            <td class="text-center align-middle"><a href="{{ route('admin.schedules.edit', $schedule->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form id="deleteElement-{{$schedule->id}}" action="{{ route('admin.schedules.destroy',$schedule->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="deleteAction(event, {{ $schedule->id }})" class="btn btn-block"><i class="fas fa-trash text-red"></i></button>
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
                {{ $schedules->links('vendor.pagination.custom-basic') }}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop