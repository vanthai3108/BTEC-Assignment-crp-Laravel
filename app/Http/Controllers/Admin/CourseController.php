<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Course\AddTraineeRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Schedule\StoreRequest as ScheduleStoreRequest;
use App\Http\Requests\StaticRequest;
use App\Models\AppConst;
use App\Models\Classs;
use App\Models\Course;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $params = $request->all();
        $classes = Classs::get();
        $subjects = Subject::get();
        $semesters = Semester::get();
        $courses = Course::with(['subject', 'class', 'semester', 'trainer'])
                            ->when($request->subject_id, function (Builder $query) use ($request) {
                                $query->where('subject_id', $request->subject_id);
                            })
                            ->when($request->class_id, function (Builder $query) use ($request) {
                                $query->where('class_id', $request->class_id);
                            })
                            ->when($request->semester_id, function (Builder $query) use ($request) {
                                $query->where('semester_id', $request->semester_id);
                            })
                            ->when(isset($request->status) && $request->status != 1, function (Builder $query) use ($request) {
                                $query->where('status', 0);
                            })
                            ->when($request->status, function (Builder $query) use ($request) {
                                $query->where('status', $request->status);
                            })
                            ->when($request->keyword, function (Builder $query) use ($request) {
                                $query->where(function (Builder $query) use ($request) {
                                    $query->orWhereHas('subject', function (Builder $query) use ($request) {
                                                $query->where('name', 'like', '%'.$request->keyword.'%');
                                            })
                                            ->orWhereHas('class', function (Builder $query) use ($request) {
                                                $query->where('name', 'like', '%'.$request->keyword.'%');
                                            })
                                            ->orWhereHas('semester', function (Builder $query) use ($request) {
                                                $query->where('name', 'like', '%'.$request->keyword.'%');
                                            })
                                            ->orWhereHas('trainer', function (Builder $query) use ($request) {
                                                $query->where('name', 'like', '%'.$request->keyword.'%');
                                            });
                                });
                            })
                        ->orderBy('semester_id', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->paginate($request->limit);
        return view('admin.course.list', compact('courses', 'classes', 'subjects', 'semesters', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classs::where('status', AppConst::ACTIVE)->get();
        $subjects = Subject::where('status', AppConst::ACTIVE)->get();
        $semesters = Semester::where('status', AppConst::ACTIVE)->get();
        $trainers = User::where('status', AppConst::ACTIVE)
                        ->where('role_id', AppConst::ROLE_TRAINER)->get();
        return view('admin.course.create', compact('classes', 'subjects', 'semesters', 'trainers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $course = new Course();
        $course->fill($request->all());
        $course->save();
        return redirect()->route('admin.courses.create')
                            ->with('success', __('message.course.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Request $request)
    {
        $course->load(['subject', 'class', 'semester', 'trainer']);
        $users = User::whereHas('courses', function (Builder $query) use ($course) {
            $query->where('course_id', $course->id);
        })->paginate(5, ['*'], 'user_page');
        $schedules = Schedule::with(['shift', 'location'])
                                ->where('course_id', $course->id)
                                ->orderBy('date', 'ASC')
                                ->paginate(10, ['*'], 'schedule_page');
        // dd($users, $schedules, $request);
        $grades = DB::table('course_user')
                        ->where('course_id', $course->id)
                        ->select('status', DB::raw('count(*) as total'))
                        ->groupBy('status')->get();
        // dd($grades)
        // $tests = Test::whereHas('course_id');
        return view('admin.course.detail', compact('course', 'users', 'schedules', 'grades'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $classes = Classs::where('status', AppConst::ACTIVE)->get();
        $subjects = Subject::where('status', AppConst::ACTIVE)->get();
        $semesters = Semester::where('status', AppConst::ACTIVE)->get();
        $trainers = User::where('status', AppConst::ACTIVE)
                        ->where('role_id', AppConst::ROLE_TRAINER)->get();
        return view('admin.course.edit', compact('course', 'classes', 'subjects', 'semesters', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->fill($request->all());
        $course->save();
        return redirect()->route('admin.courses.edit', $course->id)
                ->with('success', __('message.course.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', __('message.course.delete_success'));
    }

    public function addTraineeView(Course $course)
    {
        $trainees = User::where([
                            'role_id' => AppConst::ROLE_TRAINEE,
                            'status' => AppConst::ACTIVE
                        ])
                        ->whereDoesntHave('courses', function (Builder $query) use ($course) {
                            $query->where('course_id', '=', $course->id);
                        })->get();
        return view('admin.course.addTrainee', compact('trainees', 'course'));
    }

    public function trainees(Course $course, Request $request)
    {
        $trainees = User::where([
                            'role_id' => AppConst::ROLE_TRAINEE,
                            'status' => AppConst::ACTIVE
        ])->whereDoesntHave('courses', function (Builder $query) use ($course) {
            $query->where('course_id', '=', $course->id);
        })->when($request->keyword, function (Builder $query) use ($request) {
            $query->where(function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->keyword.'%')
                        ->orWhere('email', 'like', '%'.$request->keyword.'%');
            });
        })
        ->limit(10)->get();
        return response()->json($trainees);
    }

    public function addTrainee(Course $course, AddTraineeRequest $request)
    {
        // dd($request->all());
        $users = $request->users;
        foreach($users as $user) {
            $userCount = DB::table('course_user')
                        ->where([
                            'user_id' => $user,
                            'course_id' => $course->id
                        ])->count();
            if ($userCount == 0) {
                $course->users()->attach($user);
            }
        }
        
        return redirect()->route('admin.courses.add_trainee_view', $course->id)
                                ->with('success', __('message.course.add_trainee_success'));
    }

    public function deleteTrainee(Course $course, User $user)
    {
        $course->users()->detach($user->id);
        return redirect()->back()->with('success', __('message.course.delete_trainee_success'));
    }

    public function addScheduleView(Course $course)
    {
        $shifts = Shift::where('status', AppConst::ACTIVE)->get();
        $locations = Location::where('status', AppConst::ACTIVE)->get();
        return view('admin.schedule.create', compact('course', 'shifts', 'locations'));
    }

    public function static(StaticRequest $request)
    {
        // dd($request->getRequestUri());
        $path = $request->getPathinfo();
        $uri = $request->getRequestUri();
        $searchQueries = str_replace($path, "", $uri);
        // dd($searchQueries);
        $params = $request->all();
        $classes = Classs::get();
        $subjects = Subject::get();
        $semesters = Semester::get();
        $users = User::select('campus_id', DB::raw('count(*) as total'))
        ->groupBy('campus_id')
        ->orderBy('campus_id', 'DESC')
        ->get();
        
        $userGrades = User::join('course_user', 'users.id', '=', 'course_user.user_id')
                            ->join('courses', 'courses.id', '=', 'course_user.course_id')
                            ->join('classses', 'classses.id', '=', 'courses.class_id')
                            ->join('subjects', 'subjects.id', '=', 'courses.subject_id')
                            ->join('semesters', 'semesters.id', '=', 'courses.semester_id')
                            ->select(DB::raw('users.name as user_name, classses.name as class_name, course_user.score, subjects.name as subject_name, semesters.name as semester_name, users.email, course_user.status'))
                            ->when($request->class_id, function (Builder $query) use($request) {
                                $query->where('courses.class_id', $request->class_id);
                            })
                            ->when($request->subject_id, function (Builder $query) use($request) {
                                $query->where('courses.subject_id', $request->subject_id);
                            })
                            ->when($request->semester_id, function (Builder $query) use($request) {
                                $query->where('courses.semester_id', $request->semester_id);
                            })
                            ->when(isset($request->status) && $request->status != 1, function (Builder $query) use ($request) {
                                $query->where('course_user.score', '<', 50);
                            })
                            ->when($request->status, function (Builder $query) {
                                $query->where('course_user.score', '>=', 50);
                            })
                            ->when($request->keyword, function (Builder $query) use($request) {
                                $query->where(function (Builder $query) use($request) {
                                    $query->where('users.email', 'like', '%'.$request->keyword.'%')
                                        ->orWhere('users.name', 'like', '%'.$request->keyword.'%')
                                        ->orWhere('classses.name', 'like', '%'.$request->keyword.'%')
                                        ->orWhere('subjects.name', 'like', '%'.$request->keyword.'%')
                                        ->orWhere('semesters.name', 'like', '%'.$request->keyword.'%');
                                });
                            })
                            ->orderBy('course_user.score', 'DESC')
                            ->paginate($request->limit);
        return view('admin.course.static', compact('users', 'userGrades', 'params', 'classes', 'subjects', 'semesters', 'searchQueries'));
    }

    public function gradeCourse(Course $course)
    {
        if (Auth::user()->role_id = AppConst::ROLE_ADMIN) {
            $course->load('users');
            $users = User::with('courses')
                            ->whereHas('courses', function (Builder $query) use ($course) {
                                $query->where('course_id', $course->id);
                            })->orderBy('code', 'asc')->get();
            return view('admin.course.grade', compact('users', 'course'));
        }
        abort(404);
    }

    public function gradeCourseHandle(Course $course, Request $request)
    {
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
}
