<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Rules\EmailAlias;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                new EmailAlias()
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'integer', 'min:0', 'max:' . (count(Gender::cases()) - 1)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return new LoginResource($request->user());
    }
}
