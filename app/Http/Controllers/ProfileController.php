<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
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
        // $user = User::where('username', $identifier)
        //     // ->orWhere('firstname', $identifier)
        //     // ->orWhere('email', $identifier)
        //     ->firstOrFail();
        // $posts = Post::where('user_id', $user->id)->get();

        // $comments = Comment::whereIn('post_id', $posts->pluck('id'))->get();


        // return view('profile.show', [
        //     'user' => $user,
        //     'posts' => $posts,
        //     'comments' => $comments,
        // ]);


        $user = User::where('username', $identifier)
            ->firstOrFail();

        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc') // Order posts by created_at
            ->get();

        $comments = Comment::whereIn('post_id', $posts->pluck('id'))
            ->orderBy('created_at', 'desc') // Order comments by created_at
            ->get();

        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
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
            'query' => 'nullable|string|min:3',
        ]);

        // Initialize users as an empty collection if there's no query
        $users = collect();

        // Perform search if query is present
        if ($query) {
            $users = User::where('firstname', 'like', "%$query%")
                ->orWhere('middlename', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%")
                ->orWhere('username', 'like', "%$query%")
                ->get();
        }

        // Fetch recent searches
        $recentSearches = session()->get('recent_searches', []);

        // Add the current search to the recent searches
        if ($query && !in_array($query, $recentSearches)) {
            $recentSearches[] = $query;
        }

        // Limit to a certain number of recent searches (e.g., last 5)
        if (count($recentSearches) > 5) {
            array_shift($recentSearches); // Remove the oldest search
        }

        // Store the updated recent searches back into the session
        session()->put('recent_searches', $recentSearches);

        return response()->json([
            'users' => $users,
            'recentSearches' => $recentSearches,
        ]);
    }
}
