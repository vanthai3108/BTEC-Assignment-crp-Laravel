<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Schedule\IndexRequest;
use App\Http\Requests\Schedule\StoreRequest;
use App\Http\Requests\Schedule\UpdateRequest;
use App\Models\AppConst;
use App\Models\Classs;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $params = $request->all();
        $classes = Classs::get();
        $subjects = Subject::get();
        // dd($params);
        $schedules = Schedule::
                        when($request->subject_id, function (Builder $query) use ($request) {
                            $query->whereHas('course', function (Builder $query) use ($request) {
                                $query->where('subject_id', $request->subject_id);
                            });
                        })
                        ->when($request->class_id, function (Builder $query) use ($request) {
                            $query->whereHas('course', function (Builder $query) use ($request) {
                                $query->where('class_id', $request->class_id);
                            });
                        })

                        ->with(['course', 'location', 'shift'])
                        ->where('date', $request->date)->get();
        return view('admin.schedule.list', compact('schedules', 'params', 'classes', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // dd($request->all());
        $data = $request->except(['_token', 'dates']);
        foreach ($request->dates as $date) {
            $data['date'] = date("Y-m-d", strtotime($date));
            
            // dd($data);
            $schedule = new Schedule();
            $schedule->fill($data);
            $schedule->save();
        }
        return redirect()->back()
                            ->with('success', __('message.schedule.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('admin.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Schedule $schedule)
    {
        $schedule->fill($request->all());
        $schedule->save();
        return redirect()->route('admin.schedules.edit', $schedule->id)
                ->with('success', __('message.schedule.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', __('message.schedule.delete_success'));
    }

    public function attendance(Schedule $schedule)
    {
        $attendanceStatus = DB::table('schedule_user')->where('schedule_id', $schedule->id)->count();
        if($attendanceStatus == 0 && Auth::user()->role_id = AppConst::ROLE_ADMIN) {
            $users = User::whereHas('courses', function (Builder $query) use ($schedule) {
                $query->where('course_id', $schedule->course->id);
            })->orderBy('code', 'asc')->get();
            return view('admin.schedule.attendance', compact('users', 'schedule'));
        }
        abort(404);
    }

    public function attendanceHandle(Schedule $schedule, Request $request)
    {
        $userId = Auth::user()->id;
        $userAttendances = $request->except('_token');
        $statusUser = null;
        $noteUser = null;
        foreach($userAttendances as $key => $value) {
            if(str_starts_with($key, 'user') ) {
                $statusUser = str_replace("user", "", $key);
                $statusValue = $value;
            }
            if(str_starts_with($key, 'note') ) {
                $noteUser = str_replace("note", "", $key);
                $noteValue = $value;
            }
            if($statusUser == $noteUser) {
                $schedule->users()->attach(
                    [$statusUser => 
                    ['trainer_id' => $userId, 'status' => $statusValue, 'note' => $noteValue]
                ]);
            }
        }
        return redirect()->route('admin.schedules.index');
    }

    public function attendanceEdit(Schedule $schedule)
    {
        $attendanceStatus = DB::table('schedule_user')->where('schedule_id', $schedule->id)->count();
        $attendance = Schedule::with(['users'=> function ($q) {
                                    $q->orderBy('schedule_user.status', 'asc')
                                        ->orderBy('code', 'asc');
                                }])
                                ->whereHas('users', function (Builder $query) use ($schedule) {
                                    $query->where('schedule_id', $schedule->id);      
                                })
                                ->first();
        if($attendanceStatus > 0 && Auth::user()->role_id = AppConst::ROLE_ADMIN) {
            return view('admin.schedule.attendance_edit', compact('attendance'));
        }
        abort(404);
    }

    public function attendanceEditHandle(Schedule $schedule, Request $request)
    {
        $userId = Auth::user()->id;
        $userAttendances = $request->except('_token');
        // dd($userAttendances);
        $statusUser = null;
        $noteUser = null;
        foreach($userAttendances as $key => $value) {
            if(str_starts_with($key, 'user')) {
                $statusUser = str_replace("user", "", $key);
                $statusValue = $value;
            }
            if(str_starts_with($key, 'note')) {
                $noteUser = str_replace("note", "", $key);
                $noteValue = $value;
            }
            if($statusUser == $noteUser) {
                DB::table('schedule_user')->where([
                    'schedule_id' => $schedule->id,
                    'user_id' => $statusUser,
                ])->update(['trainer_id' => $userId, 'status' => $statusValue, 'note' => $noteValue]);
            }
        }
        
        return redirect()->route('admin.schedules.index');
    }

    
}
