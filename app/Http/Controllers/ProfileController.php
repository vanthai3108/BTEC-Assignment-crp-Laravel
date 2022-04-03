<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Profile\StoreRequest;
use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Models\AppConst;
use App\Models\Course;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseIndexRequest $request)
    {
        $user = Auth::user();
        $profiles = Profile::where('user_id', $user->id)->paginate($request->limit);
        return view('user.profile.list', compact('profiles'));
    }

    public function info(User $user, BaseIndexRequest $request)
    {
        $profiles = Profile::where('user_id', $user->id)->paginate($request->limit);
        if ($user->role_id == AppConst::ROLE_TRAINEE) {
            $courses = Course::with(['subject', 'class', 'trainer', 'semester'])
                            ->whereHas('users', function (Builder $query) use ($user) {
                                $query->where('user_id', $user->id);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->get();
        } elseif ($user->role_id == AppConst::ROLE_TRAINER) {
            $courses = Course::with(['subject', 'class', 'semester', 'trainer'])
                            ->where('trainer_id', $user->id)
                            ->orderBy('semester_id', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        }
        return view('user.profile.index', compact('profiles', 'user', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $profile = new Profile();
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $profile->fill($data);
        $profile->save();
        return redirect()->route('profile.create')
                            ->with('success', __('message.profile.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('user.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        if ($profile->user_id == Auth::user()->id) {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $profile->fill($data);
            $profile->save();
            return redirect()->route('profile.edit', $profile->id)
                    ->with('success', __('message.profile.update_success'));
        }
        return redirect()->route('user.profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->back()->with('success', __('message.profile.delete_success'));
    }

    public function editPassword()
    {
        return view('user.profile.edit-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        $user->password = Hash::make($request->pass);
        $user->save();
        return redirect()->back()->with('success', __('message.profile.update_pass_success'));
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        $request->file('avatar')->store('avatars');
        $filename = $request->file('avatar')->hashName();
        $user->avatar = 'storage/avatars/'.$filename;
        $user->save();
        return redirect()->route('profile.index')
                ->with('success', __('message.profile.update_avatar_success'));
    }
}
