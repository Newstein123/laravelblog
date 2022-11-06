<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    public function googleredirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        $userdata = Socialite::driver('google')->user();
        $useremail = $userdata->email;
        $loginType = 'Google';
        $uuid = Str::uuid()->toString();
        $user = User::where('email', $useremail)->where('auth_type', $loginType)->first();

        if($user) {
            Auth::login($user);
            return redirect('/');
        } else {
           $newuser =  User::create([
                'name' => $userdata->name,
                'email' => $userdata->email,
                'password' => Hash::make($uuid.now()),
                'auth_type' => 'Google',
            ]);
            Auth::login($newuser);
            return redirect('/');
        }
        
    }
    public function facebookredirect(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback()
    {
        $userdata = Socialite::driver('facebook')->user();
        $useremail = $userdata->email;
        $loginType = 'Facebook';
        $uuid = Str::uuid()->toString();
        $useremailUnique = User::where('email', $useremail)->first();
        if($useremailUnique) {
           Auth::login($useremailUnique);
           return redirect('/');
        }
        $user = User::where('email', $useremail)->where('auth_type', $loginType)->first();

        if($user) {
            Auth::login($user);
            return redirect('/');
        } else {
           $newuser =  User::create([
                'name' => $userdata->name,
                'email' => $userdata->email,
                'password' => Hash::make($uuid.now()),
                'auth_type' => 'Facebook',
            ]);
            Auth::login($newuser);
            return redirect('/');
        }
        
    }
}
