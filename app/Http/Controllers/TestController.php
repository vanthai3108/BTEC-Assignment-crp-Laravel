<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseIndexRequest;
use App\Models\AppConst;
use App\Models\CourseTest;
use App\Models\Question;
use App\Models\Test;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $params = $request->all();
        if(Auth::user()->role_id == AppConst::ROLE_TRAINER) {
            $tests = Test::where('author_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate($request->limit);
            return view('user.test.list', compact('tests', 'params'));
        } else {
            $tests = CourseTest::whereHas('course',  function (Builder $query) {
                $query->whereHas('users',  function (Builder $query) {
                    $query->where('user_id', Auth::user()->id);
                });
            })
            ->when($request->status == 1, function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query->where('date', now()->format('Y-m-d'))
                            ->where('start_time', '<=', now()->format('H:i:s'))
                            ->where('end_time', '>=', now()->format('H:i:s'));
                });
            })
            ->when($request->status == 2, function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query->where('date', now()->format('Y-m-d'))
                            ->where('start_time', '>=', now()->format('H:i:s'));
                })
                ->orWhere(function (Builder $query) {
                    $query->where('date', '>', now()->format('Y-m-d'));
                });
            })
            ->when($request->status == 3, function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query->where('date', now()->format('Y-m-d'))
                            ->where('end_time', '<=', now()->format('H:i:s'));
                })
                ->orWhere(function (Builder $query) {
                    $query->where('date', '<', now()->format('Y-m-d'));
                });
            })
            ->when($request->keyword, function (Builder $query) use ($request) {
                $query->where(function (Builder $query) use ($request) {
                    $query->whereHas('test', function (Builder $query) use ($request) {
                                $query->where('name', 'like', '%'.$request->keyword.'%');
                            })
                            ->orWhereHas('course',  function (Builder $query) use ($request) {
                                $query->where(function (Builder $query) use ($request) {
                                    $query->whereHas('class', function (Builder $query) use ($request)  {
                                        $query->where('name', 'like', '%'.$request->keyword.'%');
                                    })
                                    ->whereHas('subject', function (Builder $query)  use ($request) {
                                        $query->where('name', 'like', '%'.$request->keyword.'%');
                                    });
                                });
                    });
                });
                
            })
            ->orderBy('date', 'DESC')
            ->orderBy('start_time', 'DESC')
            ->orderBy('end_time', 'DESC')
            ->paginate($request->limit);
            return view('user.test.trainee_list', compact('tests', 'params'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $a = 5;

        return view('user.test.create', compact('a'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $test = new Test();
        $test->fill([
            'name' => $request->name,
            'author_id' => Auth::user()->id,
        ]);
        $test->save();
        if($request->questions) {
            foreach ($request->questions as $item) {
                $question = new Question();
                $question->fill([
                    'content' => $item,
                    'test_id' => $test->id,
                ]);
                $question->save();
            }
        }
        return redirect()->route('tests.index')
                            ->with('success', __('message.test.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return response()->json($test->load('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('user.test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $test->fill([
            'name' => $request->name,
            // 'author_id' => Auth::user()->id,
        ]);
        $test->save();
        Question::where('test_id', $test->id)->delete();
        if($request->questions) {
            foreach ($request->questions as $item) {
                $question = new Question();
                $question->fill([
                    'content' => $item,
                    'test_id' => $test->id,
                ]);
                $question->save();
            }
        }
        return redirect()->route('tests.index')
                            ->with('success', __('message.test.add_success'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
