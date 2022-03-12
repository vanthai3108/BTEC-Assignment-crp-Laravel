<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Campus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $users = User::with(['role', 'campus'])->paginate($request->limit);
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $campuses = Campus::get();
        return view('admin.user.create', compact('roles', 'campuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $emailArr = explode('@', $user->email);
        $user->password = Hash::make($request->password);
        $user->code = $emailArr[0];
        $user->avatar = 'storage/avatars/avatar.png';
        $user->save();
        return redirect()->route('admin.users.create')
                            ->with('success', __('message.user.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['courses']);
        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $campuses = Campus::get();
        return view('admin.user.edit', compact('user', 'roles', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return redirect()->route('admin.users.edit', $user->id)
                ->with('success', __('message.user.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', __('message.user.delete_success'));
    }

    public function blockUser(User $user)
    {
        if(Auth::user()->id != $user->id) {
            $user->status = false;
            $user->save();
            return redirect()->back()->with('success', __('message.user.block_success'));
        }
        return redirect()->back();
    }

    public function unblockUser(User $user)
    {
        if(Auth::user()->id != $user->id) {
            $user->status = true;
            $user->save();
            return redirect()->back()->with('success', __('message.user.unblock_success'));
        }
        return redirect()->back();
        
    }
}
