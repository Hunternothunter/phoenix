<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:25'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'mobile_num' => ['nullable', 'string', 'max:25'],
            'username' => ['required', 'lowercase', 'string', 'max:16', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $firstname = ucwords(strtolower($request->firstname));
        $middlename = $request->middlename ? ucwords(strtolower($request->middlename)) : null;
        $lastname = ucwords(strtolower($request->lastname));

        $user = User::create([
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'mobile_num' => $request->mobile_num,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
