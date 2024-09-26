<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\UserService;

class RegisteredUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $posts = Post::with('user')->latest()->get();
        $following = $user->following;
        $activities = [];

        $allUsers = User::all(); // You may want to filter based on your logic
        $recommendedUserIds = $this->userService->recommendUsers($user, $allUsers);
        $recommendedUsers = User::whereIn('id', $recommendedUserIds)->get();

        return view('dashboard', compact('posts', 'user', 'following', 'activities', 'recommendedUsers'));
    }


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
