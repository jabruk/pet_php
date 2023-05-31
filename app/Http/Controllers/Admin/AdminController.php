<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Show a profile view.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.admin_profile', compact('user'));
    }

    /**
     * Show a profile view.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.admin_profile_edit', compact('user'));
    }

    /**
     * Store a profile data.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
    }
}
