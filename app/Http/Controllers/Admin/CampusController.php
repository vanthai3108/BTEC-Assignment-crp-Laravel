<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Campus\StoreRequest;
use App\Http\Requests\Campus\UpdateRequest;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $campuses = Campus::paginate($request->limit);
        return view('admin.campus.list', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $campus = new Campus();
        $campus->fill($request->all());
        $campus->save();
        return redirect()->route('admin.campuses.create')
                            ->with('success', __('message.campus.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function show(Campus $campus)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        return view('admin.campus.edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Campus $campus)
    {
        $campus->fill($request->all());
        $campus->save();
        return redirect()->route('admin.campuses.edit', $campus->id)
                ->with('success', __('message.campus.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();
        return redirect()->back()->with('success', __('message.campus.delete_success'));
    }
}
