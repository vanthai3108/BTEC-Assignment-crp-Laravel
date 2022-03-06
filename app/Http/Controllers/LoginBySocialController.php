<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginBySocialController extends Controller
{
    public function loginSocial($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function loginSocialHandle($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        if(!$user) {
            return redirect('/login');
        }
        if($provider === 'google') {
            $getUser = $this->loginWithGoogle($user); 
        }
        Auth::login($getUser);

        return redirect('/');
    }

    public function loginWithGoogle($user)
    {
        $getUser = User::where('google_id', $user->id)->first();
        if(!$getUser) {
            $getEmail = User::where('email', $user->email)->first();
            if(!$getEmail) {
                $emailArr = explode('@', $user->email);
                $getUser = User::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'code' => $emailArr[0],
                    'password' => Str::random(50),
                    'avatar' => $user->avatar,
                    'role_id' => AppConst::ROLE_TRAINEE,
                    'google_id' => $user->id
                ]);
            } else {
                $getUser = $getEmail->fill(['google_id' => $user->id]);
                $getUser->save();
            }
        }
        return $getUser;
    }
}
