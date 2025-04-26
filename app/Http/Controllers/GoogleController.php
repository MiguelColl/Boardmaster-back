<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Login;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Str;

class GoogleController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $google = Socialite::driver('google')->user();
        } catch (Exception $e) {
            abort('401');
        }

        $user = User::where('email', $google->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $google->name,
                'email' => $google->email,
                'password' => Hash::make(Str::random(40)),
            ]);

            event(new Registered($user));
        }

        $user->login_at = Carbon::now();
        $user->update();

        Auth::login($user);

        return response()->json(Login::getInfo());
    }
}
