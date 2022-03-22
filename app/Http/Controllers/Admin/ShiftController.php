<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Shift\StoreRequest;
use App\Http\Requests\Shift\UpdateRequest;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $params = $request->all();
        $shifts = Shift::
            when(isset($request->status) && $request->status != 1, function (Builder $query) use ($request) {
                $query->where('status', 0);
            })
            ->when($request->status, function (Builder $query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->keyword, function (Builder $query) use ($request) {
                $query->where(function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%'.$request->keyword.'%')
                            ->orWhere('start_time', 'like', '%'.$request->keyword.'%')
                            ->orWhere('end_time', 'like', '%'.$request->keyword.'%');
                });
            })
            ->orderBy('start_time', 'ASC')->paginate($request->limit);
        return view('admin.shift.list', compact('shifts', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $shift = new Shift();
        $shift->fill($request->all());
        $shift->save();
        return redirect()->route('admin.shifts.create')
                            ->with('success', __('message.shift.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return view('admin.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Shift $shift)
    {
        $shift->fill($request->all());
        $shift->save();
        return redirect()->route('admin.shifts.edit', $shift->id)
                ->with('success', __('message.shift.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->back()->with('success', __('message.shift.delete_success'));
    }
}
