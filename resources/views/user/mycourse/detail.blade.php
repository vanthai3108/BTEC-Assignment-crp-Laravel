@extends('layouts.app')

@section('title', 'My course')

@section('content_header')
    <h1>List courses</h1>
@stop
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center bg-info">
            <h3 class="card-title text-center">
                {{ $course->class->name }} - {{ $course->subject->name }}
                <span class="right badge badge-danger">{{ $course->semester->name }}</span>
                <span class="right badge badge-primary"> Trainer: {{ $course->trainer->name }}</span>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- <div class="card {{ $users->currentPage() != 1 ? '': 'collapsed-card'}}"> --}}
            @if(Auth::user()->id == 2)
            <div class="card-header bg-white">
                <h3 class="card-title text-center">
                    <a href="{{ route('my_course.grade', $course->id) }}" class="text-success">
                        <i class="fas fa-plus text-success"></i> Grading
                    </a>
                </h3>
            </div>
            @endif
            @if(Auth::user()->id != 2)
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"><i class="fas fa-fw fa-lg fa-calendar-check"></i> Attendance history
                        <span class="right badge bg-pink">Absent: {{$absents}}/{{count($attendances)}} ({{$absentsPercent}}%)</span>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table class="table table-striped projects">
                        <thead>
                            <tr class="bg-olive">
                                <th class="text-center">#</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Shift</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Marked by</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center">{{ date('D - d/m/Y', strtotime($schedule->date)) }}</td>
                                    <td class="align-middle text-center">
                                        {{ $schedule->shift->name }}
                                        ({{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }})
                                    </td>
                                    <td class="align-middle text-center">{{ $schedule->location->room }} - {{ $schedule->location->building }}</td>
                                        @foreach ($attendances as $attendance)
                                            @if($attendance->schedule_id === $schedule->id)
                                                @php $check = true @endphp
                                                <td class="text-center align-middle">
                                                    {{ $attendance->trainer->code }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($attendance->status)
                                                        <p class="text-success mb-0">Attended</p>
                                                    @else
                                                        <p class="text-danger mb-0">Absent</p>
                                                    @endif
                                                </td>
                                                
                                                <td class="text-center align-middle">
                                                    @if($attendance->note)
                                                        {{ $attendance->note }}
                                                    @else
                                                        
                                                    @endif
                                                </td>
                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$check)
                                        <td class="text-center align-middle">
                                            -
                                        </td>
                                        <td class="text-center align-middle">
                                            Not yet
                                        </td>
                                        <td class="text-center align-middle">
                                            
                                        </td>
                                        @endif
                                        @php $check = false @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm m-0 justify-content-center">
                        {{-- {{ $attendances->links('vendor.pagination.custom-detail', ['psecond' => $users->links()->paginator]) }} --}}
                    </ul>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"><i class="fas fa-fw fa-lg fa-users"></i> Trainees 
                        <span class="right badge bg-pink">{{ $users->links()->paginator->total() }}</span>
                    </h3>
                    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table class="table table-striped projects mb-3">
                        <thead>
                            <tr class="bg-olive">
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Campus</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center align-middle">{{ ($users->currentPage() - 1)  * $users->perpage() + $loop->iteration }}</td>
                                    <td class="align-middle"><a href="{{ route('info', $user->id) }}">{{ $user->name }}</a></td>
                                    <td class="align-middle text-center">
                                        @if(!str_starts_with($user->avatar, 'http'))
                                            <img class="table-avatar" src="{{ config('app.url').'/'.$user->avatar }}" alt="avatar">
                                        @else
                                            <img class="table-avatar" src="{{ $user->avatar }}" alt="avatar">
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    @if ($user->campus)
                                        <td class="align-middle text-center">{{ $user->campus->name }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm m-0 justify-content-center">
                        {{ $users->links('vendor.pagination.custom-basic') }}
                        {{-- {{ $users->links('vendor.pagination.custom-detail', ['psecond' => $attendances->links()->paginator]) }} --}}
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
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    
@stop