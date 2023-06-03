<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
    public function edit(Request $_request): View
    {
        return view('profile.edit', [
            'user' => $_request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $_request): RedirectResponse
    {
        $_request->user()->fill($_request->validated());

        if ($_request->user()->isDirty('email')) {
            $_request->user()->email_verified_at = null;
        }

        $_request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $_request): RedirectResponse
    {
        $_request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $_request->user();

        Auth::logout();

        $user->delete();

        $_request->session()->invalidate();
        $_request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
