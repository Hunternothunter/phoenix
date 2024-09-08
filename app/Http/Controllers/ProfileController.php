<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function show($identifier): View
    {
        $user = User::where('email', $identifier)
            ->orWhere('name', $identifier)
            ->orWhere('username', $identifier)
            ->firstOrFail();

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate the query if needed
        $request->validate([
            'query' => 'required|string|min:3',
        ]);

        // Search users by name, or username
        $users = User::where('firstname', 'like', "%$query%")
            ->orWhere('middlename', 'like', "%$query%")
            ->orWhere('lastname', 'like', "%$query%")
            ->orWhere('username', 'like', "%$query%")
            ->get();

        return view('profile.search_results', ['users' => $users, 'query' => $query]);
    }
}
