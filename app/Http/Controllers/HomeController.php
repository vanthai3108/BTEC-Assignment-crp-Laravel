<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\BaseScheduleRequest;
use App\Models\AppConst;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function myCourse(BaseScheduleRequest $request)
    {
        $user = Auth::user();
        $courses = null;
        if ($user->role_id == AppConst::ROLE_TRAINEE) {
            $courses = Course::with(['subject', 'class', 'trainer', 'semester'])
                            
                            ->whereHas('users', function (Builder $query) use ($user) {
                                $query->where('user_id', $user->id);
                            })
                            ->orderBy('created_at', 'DESC')
                            // ->whereHas('semester', function (Builder $query) use ($user) {
                            //     $query->orderBy('id', 'ASC');
                            // })
                            
                            ->paginate($request->limit);
        } elseif ($user->role_id == AppConst::ROLE_TRAINER) {
            $courses = Course::with(['subject', 'class', 'semester', 'trainer'])
                            ->where('trainer_id', $user->id)
                            ->orderBy('status', 'DESC')
                            ->orderBy('semester_id', 'DESC')
                            
                            ->paginate($request->limit);
        }
        // dd(now()->format('Y-m-d'), $courses[0]->schedules[0]->date);
        return view('user.mycourse.list', compact('courses'));
    }

    public function showCourse(Course $course, BaseIndexRequest $request)
    {
        $user = Auth::user();
        $course->load(['subject', 'class', 'semester', 'trainer']);
        $users = User::whereHas('courses', function (Builder $query) use ($course) {
            $query->where('course_id', $course->id);
        })->paginate(5, ['*'], 'user_page');
        $schedules = Schedule::where('course_id', $course->id)->get();
        $attendances = Schedule::join('schedule_user', 'schedule_user.schedule_id', '=', 'schedules.id')
                                ->where('course_id', $course->id)
                                ->where('user_id', $user->id)->get();
        // dd($schedules, $attendances);
        $absents = Schedule::join('schedule_user', 'schedule_user.schedule_id', '=', 'schedules.id')
                                ->where('course_id', $course->id)
                                ->where('user_id', $user->id)
                                ->where('status', 0)
                                ->count();
        $check = false;
        $absentsPercent = count($attendances) ? round($absents/count($attendances), 2)*100 : 0; 

        return view('user.mycourse.detail', compact('course', 'users', 'attendances', 'schedules', 'absents', 'absentsPercent', 'check'));
    }

    public function mySchedule(BaseScheduleRequest $request)
    {
        $user = Auth::user();
        $schedules = null;
        if ($user->role_id == AppConst::ROLE_TRAINEE) {
            $schedules = Schedule::with(['course', 'location', 'shift'])
                                    ->whereHas('course', function (Builder $query) use ($user) {
                                        $query->whereHas('users', function (Builder $query) use ($user) {
                                            $query->where('user_id', $user->id);
                                        });
                                    })
                                    ->where('date', '>=', now()->format('Y-m-d'))
                                    ->orderBy('date', 'ASC')
                                    ->orderBy('shift_id', 'ASC')
                                    ->paginate($request->limit);
                                    
        } elseif ($user->role_id == AppConst::ROLE_TRAINER) {
            $schedules = Schedule::with(['course', 'location', 'shift'])
                                    ->whereHas('course', function (Builder $query) use ($user) {
                                        $query->where('trainer_id', $user->id);
                                    })
                                    ->where('date', '>=', now()->format('Y-m-d'))
                                    ->orderBy('date', 'ASC')
                                    ->orderBy('shift_id', 'ASC')
                                    ->paginate($request->limit);
        }

        return view('user.myschedule.list', compact('schedules'));
    }

    public function attendanceView(Schedule $schedule)
    {
        $attendance = Schedule::with(['users'=> function ($q) {
            $q->orderBy('schedule_user.status', 'asc')
                ->orderBy('code', 'asc');
        }])
        ->whereHas('users', function (Builder $query) use ($schedule) {
            $query->where('schedule_id', $schedule->id);      
        })
        ->first();
            return view('user.mycourse.attendance_view', compact('attendance'));
    }

    public function attendance(Schedule $schedule)
    {
        $attendanceStatus = DB::table('schedule_user')->where('schedule_id', $schedule->id)->count();
        if($schedule->date == now()->format('Y-m-d') && $attendanceStatus == 0
            && $schedule->course->trainer->id == Auth::user()->id) {
            $users = User::whereHas('courses', function (Builder $query) use ($schedule) {
                $query->where('course_id', $schedule->course->id);
            })->orderBy('code', 'asc')->get();
            return view('user.myschedule.attendance', compact('users', 'schedule'));
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
        return redirect()->route('my_schedule.list');
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
        if($attendanceStatus > 0 && $schedule->date == now()->format('Y-m-d') && $schedule->course->trainer->id == Auth::user()->id) {
            return view('user.myschedule.attendance_edit', compact('attendance'));
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
        
        return redirect()->route('my_schedule.list');
    }

    public function gradeCourse(Course $course)
    {
        if ($course->trainer->id == Auth::user()->id) {
            $course->load('users');
            $users = User::with('courses')
                            ->whereHas('courses', function (Builder $query) use ($course) {
                                $query->where('course_id', $course->id);
                            })->orderBy('code', 'asc')->get();
            return view('user.mycourse.grade', compact('users', 'course'));
        }
    }

    public function gradeCourseHandle(Course $course, Request $request)
    {
        if(Carbon::now()->subDays(14)->format('Y-m-d') <= $course->end_date) {
            $userAttendances = $request->except('_token');
            foreach($userAttendances as $key => $value) {
                $status = 0;
                if(str_starts_with($key, 'score') ) {
                    $user = str_replace("score", "", $key);
                    if ($value >= AppConst::PASS) {
                        $status = 1;
                    }
                    $course->users()->detach($user);
                    $course->users()->attach(
                        [$user => 
                        ['status' => $status, 'score' => $value]
                    ]);
                }
            }
            return redirect()->back()->with('success', __('message.grade.success'));
        } 

        return redirect()->back()->with('failed', __('message.grade.failed'));
    }
}
