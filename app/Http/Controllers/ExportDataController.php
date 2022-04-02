<?php

namespace App\Http\Controllers;

use App\Exports\CourseGradeExport;
use App\Exports\StaticCourseGradeExport;
use App\Http\Requests\StaticRequest;
use App\Models\Classs;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    public function exportGrades(Course $course) 
    {
        $users = User::with(['role'])
        ->join('course_user', 'users.id', '=', 'course_user.user_id')
        ->join('courses', 'courses.id', '=', 'course_user.course_id')
        ->join('classses', 'classses.id', '=', 'courses.class_id')
        ->join('subjects', 'subjects.id', '=', 'courses.subject_id')
        ->join('semesters', 'semesters.id', '=', 'courses.semester_id')
        ->where('course_id', $course->id)
        ->select(DB::raw('users.name as name, email, users.code as code, score, course_user.status 
                        as course_user_status, subjects.name as subject_name, classses.name as class_name'))
        ->orderBy('score', 'DESC')
        ->get();
        $columns = ["Email", "Code", "Name", "Scores", "Status"];
        $title = "Transcript of the course ".$course->class->name
                ." - ".$course->subject->name
                ." (".$course->semester->name.")";
        return Excel::download(new CourseGradeExport($users, $columns, $title), $title.'.xlsx');
    }

    public function exportStaticGrades(StaticRequest $request) 
    {

        $title = "Student transcript statistics with";
        if ($request->class_id) {
            $class = Classs::where('id', $request->class_id)->first();
            $title = $title." Class: ".$class->name;
        }
        if ($request->subject_id) {
            $subject = Subject::where('id', $request->subject_id)->first();
            $title = $title." - Subject: ".$subject->name;
        }
        if ($request->semester_id) {
            $semester = Semester::where('id', $request->semester_id)->first();
            $title = $title." - Semester: ".$semester->name;
        }
        if (isset($request->status) && $request->status != 1) {
            $title = $title." - Status: Failed";
        } else if(isset($request->status) && $request->status == 1) {
            $title = $title." - Status: Passed";
        }

        if ($request->keyword) {
            $title = $title." - Keyword: ".$request->keyword;
        } 
        // $request->class_id ? $title." Class: ".
        $users = User::join('course_user', 'users.id', '=', 'course_user.user_id')
                            ->join('courses', 'courses.id', '=', 'course_user.course_id')
                            ->join('classses', 'classses.id', '=', 'courses.class_id')
                            ->join('subjects', 'subjects.id', '=', 'courses.subject_id')
                            ->join('semesters', 'semesters.id', '=', 'courses.semester_id')
                            ->select(DB::raw('users.name as user_name, users.code, classses.name as class_name, course_user.score, subjects.name as subject_name, semesters.name as semester_name, users.email, course_user.status'))
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
                            ->orderBy('course_user.score', 'DESC')->get();
        $columns = ["Email", "Code", "Name", "Class", "Subject", "Semester", "Scores", "Status"];
        return Excel::download(new StaticCourseGradeExport($users, $columns, $title), $title.'.xlsx');
    }
}
