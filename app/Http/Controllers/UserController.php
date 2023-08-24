<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function index2()
    {
        $users = User::all();
        return view('Admin.pages.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.Users.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'max:100', 'min:6'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpej'],
            'role' => ['required']
        ]);

        $ext = $request->file('image')->extension();
        $img_name = "user" . time() . rand(1, 1000000) . $ext;
        $request->file('image')->move(public_path('Admin\users'), $img_name);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => "Admin\\users\\" . $img_name,
            'role' => $request->role
        ]);

        return redirect()->route('user.index2')->with('success', "the user stored successfuly");
    }

    public function edit(User $user)
    {
        // dd($major);
        return view('Admin.pages.Users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'role' => ['required']
        ]);

        if ($request->file('image')) {

            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $ext = $request->file('image')->extension();
            $img_name = "user" . time() . rand(1, 1000000) . $ext;
            $request->file('image')->move(public_path('Admin\users'), $img_name);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => "Admin\\users\\" . $img_name,
                'role' => $request->role
            ]);

            return redirect()->route('user.index2')->with('success', "the user updated successfuly");
        } else {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);

            return redirect()->route('user.index2')->with('success', "the user updated successfuly");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index2')->with('success', "the user " . $user->name . " deleted successfuly");
    }
}
