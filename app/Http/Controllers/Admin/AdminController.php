<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * Change password view.
     */
    public function changePassword()
    {
        $user = Auth::user();
        return view('admin.admin_change_password', compact('user'));
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);
        $hashedPassword = $user->password; 
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find($user->id);
            $user->password = bcrypt($request->newpassword);

            $user->save();

            session()->flash('message', 'Password has been successfully updated!');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old password is not matched.');
            return redirect()->back();
        }
    }

    /**
     * Store a profile data.
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $file = $request->file('profile_image');
        if ( $file ) {
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$fileName);
            $user->profile_image = $fileName;
        }

        $user->save();
        $notification = array(
            'message' => "Data has been saved successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }
}
