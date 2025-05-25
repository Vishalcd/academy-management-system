<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    // @desc Update
    // @route PUT /settings
    public function update(Request $request)
    {
        // Get Logged in user
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|integer',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp:max:10240',
        ]);

        // check for image
        if ($request->hasFile('photo')) {
            // delete old photo
            Storage::delete('public/users/'.basename($user->photo));

            // store the file and get
            $path = $request->file("photo")->store('users', 'public');


            // Add path to validated data
            $validatedData['photo'] = $path;
        }

        // Submit to database
        $user->update($validatedData);

        return view('settings.index');
    }
}
