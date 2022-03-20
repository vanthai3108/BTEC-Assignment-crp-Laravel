<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $params = $request->all();
        $categories = Category::
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
        return view('admin.category.list', compact('categories', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        return redirect()->route('admin.categories.create')
                            ->with('success', __('message.category.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return redirect()->route('admin.categories.edit', $category->id)
                ->with('success', __('message.category.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', __('message.category.delete_success'));
    }
}
