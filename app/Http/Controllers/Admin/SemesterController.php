<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Semester\StoreRequest;
use App\Http\Requests\Semester\UpdateRequest;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $params = $request->all();
        $semesters = Semester::
                            when(isset($request->status) && $request->status != 1, function (Builder $query) use ($request) {
                                $query->where('status', 0);
                            })
                            ->when($request->status, function (Builder $query) use ($request) {
                                $query->where('status', $request->status);
                            })
                            ->when($request->keyword, function (Builder $query) use ($request) {
                                $query->where(function (Builder $query) use ($request) {
                                    $query->where('name', 'like', '%'.$request->keyword.'%');
                                });
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate($request->limit);
        return view('admin.semester.list', compact('semesters', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.semester.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $semester = new Semester();
        $semester->fill($request->all());
        $semester->save();
        return redirect()->route('admin.semesters.create')
                            ->with('success', __('message.semester.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        return view('admin.semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Semester $semester)
    {
        $semester->fill($request->all());
        $semester->save();
        return redirect()->route('admin.semesters.edit', $semester->id)
                ->with('success', __('message.semester.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->back()->with('success', __('message.semester.delete_success'));
    }
}
