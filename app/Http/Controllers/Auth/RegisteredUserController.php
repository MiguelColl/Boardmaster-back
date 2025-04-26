<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Login;
use Carbon\Carbon;
use Closure;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class,
                function (string $attribute, mixed $value, Closure $fail) {
                    $email = explode('@', $value)[0];
                    if (strpos($email, '+') != false) {
                        $fail("The {$attribute} cannot contain '+' characters.");
                    }
                },
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
            'login_at' => Carbon::now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->json(Login::getInfo());
    }
}
