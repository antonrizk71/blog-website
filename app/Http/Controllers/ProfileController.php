<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\Uploadimage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use Uploadimage;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update_image(Request $request)
    {
        $user = User::find(Auth::user()->id);
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = $user->image;
            if ($request->hasFile('image')) {
                $path = public_path('upload_images/' . $imageName);
                if (file_exists($path)) {
                    try {
                        unlink($path);
                    } catch (\Exception $e) {

                        report($e);
                    }
                }
                $imageName = $this->uploadImage($request, 'image', 'users_images');
            }
            $user->update([
                'image' => $imageName,
            ]);
            alert()->success('User', 'Your profile picturee updated successfully');
        } catch (\Exception $e) {
            alert()->error('User', 'Failed to update profile picture ');
            return redirect()->back();
        }
        return redirect()->back();
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
}
