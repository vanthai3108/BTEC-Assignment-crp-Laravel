<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use App\Models\Question;
use App\Models\Test;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == AppConst::ROLE_TRAINER) {
            $tests = Test::where('author_id', Auth::user()->id)->get();
        } else {
            // $tests = Test::whereHas('courses', function())
            // ->get();
        }
        return view('user.test.list', compact('tests'));
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
