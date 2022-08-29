<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\PasswordUpdate as PasswordUpdateRequest;
use App\Http\Requests\Profile\Update as UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Profile extends Controller
{
    public function index()
    {
        return view('user.profile.index',[ 'user'=> Auth::user() ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(auth()->id());
            if(isset($data['picture']))
                {
                    if($user->picture != 'nopicture.png')
                        {
                            Storage::delete("public/img/users/$user->picture");
                        }
                    $file = $data['picture'];
                    $fileName = $request->setPictureName($data['picture']);
                    $user->update(['name' => $data['name'],'picture' => $fileName]);
                    Storage::putFileAs('public/img/users/', $file, $fileName);
                } else {
                    $user->update(['name' => $data['name']]);
                }
        return redirect()->back();
    }

    public function editPassword()
    {
        return view('user.profile.editPassword');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $request->user()->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60)
        ])->save();
        return redirect()->route('profile.index')->with('notification','password.change');
    }
}
