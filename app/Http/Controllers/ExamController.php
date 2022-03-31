<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\AddTestRequest;
use App\Models\AppConst;
use App\Models\Course;
use App\Models\CourseTest;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $tests = Test::where('author_id', Auth::user()->id)->get();
        // dd($tests);
        return view('user.test.addtocourse', compact('tests', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTestRequest $request)
    {
        $exam = new CourseTest();
        $exam->fill($request->all());
        $exam->save();
        return redirect()->route('my_course.show', $request->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CourseTest $courseTest)
    {
        $userTest = DB::table('course_user')->where([
            'course_id' => $courseTest->course_id,
            'user_id' => Auth::user()->id,
        ])->count();
        $check = DB::table('test_user')->where([
            'user_id' => Auth::user()->id,
            'test_course_id' => $courseTest->id
        ])->count();
        if ($courseTest->date == now()->format('Y-m-d') 
            && now()->format('H:i:s') <= $courseTest->end_time 
            && now()->format('H:i:s') >= $courseTest->start_time 
            && $userTest > 0 && $check == 0) {
                $test = Test::where('id', $courseTest->test_id)->first();
                $questions = Question::where('test_id', $courseTest->test_id)->get();
            return view('user.test.coursetest', compact('courseTest', 'test', 'questions'));
        }
        abort(404);
    }

    public function submit(CourseTest $courseTest, Request $request)
    {
        $test = Test::where('id', $courseTest->test_id)->first();
        $userId = Auth::user()->id;
        $courseTestId = $courseTest->id;
        $count = 0;
        $exam = null;
        $submit = null;
        $index = 1;
        foreach($request->all() as $key => $value) {
            if(str_starts_with($key, 'question') ) {
                $questionId = str_replace("question-", "", $key);
                $question = Question::where('id', $questionId)->first();
                $exam['question '.$index] = json_decode($question->content);
                $submit['question '.$index] = $value;
                if (json_decode($question->content)->trueAnswer == $value) {
                    $count++;
                    $submit['question '.$index] = $submit['question '.$index]."(true)";
                } else {
                    $submit['question '.$index] = $submit['question '.$index]."(false)";
                }
                $index++;
            }
        }
        $totalQuestion = Question::where('test_id', $courseTest->test_id)->count();
        // dd($totalQuestion)
        $result = $count."/".$totalQuestion;
        $user =  User::where('id', $userId)->first();
        $user->courseTest()->attach([
            $courseTestId => ['exam' => json_encode($exam), 'submit' => json_encode($submit), 'result' => $result]
        ]);
        return redirect()->route('my_course.course_test_result', $courseTest->id);
    }

    public function result(CourseTest $courseTest) {
        if(Auth::user()->role_id == AppConst::ROLE_TRAINEE) {
            $test = Test::where('id', $courseTest->test_id)->first();
            $userTest = DB::table('course_user')->where([
                'course_id' => $courseTest->course_id,
                'user_id' => Auth::user()->id,
            ])->count();
            $check = DB::table('test_user')->where([
                'user_id' => Auth::user()->id,
                'test_course_id' => $courseTest->id
            ])->count();
            if ($courseTest->date == now()->format('Y-m-d') 
                && now()->format('H:i:s') <= $courseTest->end_time 
                && now()->format('H:i:s') >= $courseTest->start_time 
                && $userTest > 0 && $check > 0 ) { 
                    $result = DB::table('test_user')->where([
                        'user_id' => Auth::user()->id,
                        'test_course_id' => $courseTest->id
                    ])->first();

                    return view('user.test.coursetest_result', compact('result', 'test', 'courseTest'));
            } else {
                abort(404);
            }
        } else {
            $courseTest->load('users');
            $users = User::with('courses')
                            ->whereHas('courses', function (Builder $query) use ($courseTest) {
                                $query->where('course_id', $courseTest->course_id);
                            })->get();
            // dd($users, $courseTest);
            return view('user.test.coursetest_result_trainer', compact('users', 'courseTest'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseTest $courseTest)
    {
        // dd('ok');
        if (($courseTest->date > now()->format('Y-m-d') || 
        ($courseTest->date == now()->format('Y-m-d') && now()->format('H:i:s') <= $courseTest->end_time && 
        now()->format('H:i:s') <= $courseTest->start_time)) && Auth::user()->role_id==AppConst::ROLE_TRAINER) {
            // dd('ok');
            $courseTest->delete();
            return redirect()->back()->with('success', __('message.course_test.delete_success'));
        }
        abort(404);
    }
}
