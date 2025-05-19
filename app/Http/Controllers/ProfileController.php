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

    public function dashboard()
    {
        return view('dashboard');
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
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->post());
        // dd($request->user());


        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/storage/image/', $name);
            $profile_image = '/storage/image/' . $name;
        }else{
            $profile_image = $request->old_profile_image;
        }



        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        User::where('id', $request->user()->id)->update(['mode'=>$request->mode , 'profile_image'=>$profile_image]);

        $request->user()->save();

        return redirect()->route('admin.profile.edit')->with('status', 'profile-updated');

        User::where('id', $request->user()->id)->update(['mode'=>$request->mode]);

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');

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


    public function removeProfilePhoto($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->profile_image = null;
        $user->save();
        return redirect()->back()->with('success', 'Profile photo removed successfully.');
    }


    

}
