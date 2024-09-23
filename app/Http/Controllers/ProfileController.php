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
use Illuminate\Validation\Rule;

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
        
        $firstname = ucwords(strtolower($request->firstname));
        $middlename = $request->middlename ? ucwords(strtolower($request->middlename)) : null;
        $lastname = ucwords(strtolower($request->lastname));

        $user->fill([
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'email' => $request->email,
            // 'username' => $request->username,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'mobile_num' => $request->mobile_num,
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('home')->with('message', 'User profile updated successfully.');
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
