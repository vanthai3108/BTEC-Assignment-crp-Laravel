<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Course\AddTraineeRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Schedule\StoreRequest as ScheduleStoreRequest;
use App\Models\AppConst;
use App\Models\Classs;
use App\Models\Course;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $courses = Course::with(['subject', 'class', 'semester', 'trainer'])
                        ->orderBy('semester_id', 'DESC')
                        ->paginate($request->limit);
        return view('admin.course.list', compact('courses'));
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
                                ->paginate(10, ['*'], 'schedule_page');
        // dd($users, $schedules, $request);
        return view('admin.course.detail', compact('course', 'users', 'schedules'));
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
        $trainees = User::where('role_id', AppConst::ROLE_TRAINEE)->get();
        return view('admin.course.addTrainee', compact('trainees', 'course'));
    }

    public function addTrainee(Course $course, AddTraineeRequest $request)
    {
        $course->users()->attach($request->user);
        return redirect()->back()->with('success', __('message.course.add_trainee_success'));
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

    // public function addSchedule(ScheduleStoreRequest $request)
    // {
    //     $schedule = new Schedule();
    //     $schedule->fill($request->all());
    //     $schedule->save();
    //     return redirect()->route('admin.courses.add_schedule_view')
    //                         ->with('success', __('message.schedule.add_success'));
    // }
}
