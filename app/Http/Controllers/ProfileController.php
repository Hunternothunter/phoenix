<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


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
        $user = User::where('username', $identifier)
            // ->orWhere('firstname', $identifier)
            // ->orWhere('email', $identifier)
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
        $user = $request->user();

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'string', 'max:25'],
            'mobile_num' => ['nullable', 'string', 'max:30'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'username' => ['required', 'string', 'lowercase', 'email', 'max:16', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],

        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $file = $request->file('profile_picture');
            $profilePicturePath = $file->store('profile_pictures', 'public');

            $user->profile_picture = $profilePicturePath;
        }

        $user->fill($request->only([
            'firstname',
            'middlename',
            'lastname',
            'email',
            'username',
            'gender',
            'birthdate',
            'mobile_num'
        ]));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.show', $user->username)
            ->with('message', 'You successfully updated your profile information.');
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
        // Log the request input
        Log::info('Search query received:', $request->all());

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
