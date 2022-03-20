<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\AppConst;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $categories = Category::get();
        $params = $request->all();
        $subjects = Subject::with('category')->orderBy('created_at', 'DESC')
                            ->when($request->category_id, function (Builder $query) use ($request) {
                                $query->where('category_id', $request->category_id);
                            })
                            ->when(isset($request->status) && $request->status != 1, function (Builder $query) use ($request) {
                                $query->where('status', 0);
                            })
                            ->when($request->status, function (Builder $query) use ($request) {
                                $query->where('status', $request->status);
                            })
                            ->when($request->keyword, function (Builder $query) use ($request) {
                                $query->where(function (Builder $query) use ($request) {
                                    $query->where('name', 'like', '%'.$request->keyword.'%')
                                            ->orWhere('code', 'like', '%'.$request->keyword.'%')
                                            ->orWhere('sessions', 'like', '%'.$request->keyword.'%')
                                            ->orWhereHas('category', function (Builder $query) use ($request) {
                                                $query->where('name', 'like', '%'.$request->keyword.'%');
                                            });
                                });
                            })
                            ->paginate($request->limit);
        return view('admin.subject.list', compact('subjects', 'categories', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', AppConst::ACTIVE)->get();
        return view('admin.subject.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $subject = new Subject();
        $subject->fill($request->all());
        $subject->save();
        return redirect()->route('admin.subjects.create')
                            ->with('success', __('message.subject.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $categories = Category::where('status', AppConst::ACTIVE)->get();
        return view('admin.subject.edit', compact('subject', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Subject $subject)
    {
        $subject->fill($request->all());
        $subject->save();
        return redirect()->route('admin.subjects.edit', $subject->id)
                ->with('success', __('message.subject.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', __('message.subject.delete_success'));
    }
}
