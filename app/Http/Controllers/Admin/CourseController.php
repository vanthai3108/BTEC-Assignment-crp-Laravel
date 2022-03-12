<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Models\Course;
use App\Models\Schedule;
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
        $courses = Course::with(['subject', 'class', 'semester'])->orderBy('semester_id', 'DESC')->paginate($request->limit);
        return view('admin.course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
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
        $course->load(['subject', 'class', 'semester', 'schedules',
        'users' => function ($q) {
            $q->paginate(5); }]);
        $users = User::whereHas('courses', function (Builder $query) use ($course) {
            $query->where('course_id', $course->id);
        })->paginate(4, ['*'], 'user_page');
        $schedules = Schedule::where('course_id', $course->id)->paginate(5, ['*'], 'schedule_page');
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
        return view('admin.course.edit', compact('course'));
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
}
