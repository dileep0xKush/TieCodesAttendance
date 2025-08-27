<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Check if the user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Email not found.');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Auth::login($user);

            if ($user->type == 'superadmin') {
                return redirect('dashboard')->with('success', 'Signed in as Superadmin');
            }

            return redirect('home')->with('success', 'Signed in as Employee');
        } else {
            return redirect('/')->with('error', 'Invalid credentials.');
        }
    }



    public function tiktactoe()
    {
        return view('loading');
    }


    public function signupPage()
    {
        return view('signup');
    }


    public function dashboard()
    {
        return view('dashboard');
    }



    public function users(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('email', '!=', 'admin')
                ->latest()
                ->get();
            return DataTables::of($data)->make(true);
        }
        return view('users.all');
    }


    public function createUser()
    {
        return view('users.create');
    }


    public function addUser(Request $request)
    {
        // dd($request->all());
        $existing = User::where('email', $request->email)->first();

        if ($existing) {

            return redirect()->back()->with('error', __("lang.Email already exists"))->withInput();
        }

        $user = new User;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;

        if ($request->file('profile_avatar')) {

            $imageFileName = time() . '' . rand(10, 10000) . '.' . $request->file('profile_avatar')->getClientOriginalExtension();

            $directory = public_path('storage/users');

            if (!File::isDirectory($directory)) {

                File::makeDirectory($directory, 0755, true, true);
            }

            $imagePath = $directory . '/' . $imageFileName;

            $avatar = asset('/storage/users') . '/' . $imageFileName;

            request()->profile_avatar->move(public_path('storage/users'), $imageFileName);
        } else {

            $avatar = url('assets/media/users/default.jpg');
        }

        $user->avatar = $avatar;

        if ($user->save()) {

            return redirect('users')->with('success', "User created successfully");
        }

        return redirect('create/user')->with('error', "Something went wrong");
    }


    public function changeUserPassword(Request $request)
    {

        $user = User::find($request->user_id);

        $user->password = Hash::make($request->password);

        if ($user->save()) {

            return redirect('users')->with('success', "Password changed successfully");
        }

        return redirect('users')->with('error', "Something went wrong");
    }


    public function delete_user($id)
    {

        $user = User::find($id);

        $user->email .= "-removed-" . $user->id;

        if ($user->save()) {

            $user->delete();

            return redirect('users')->with('success', "User deleted successfully");
        }

        return redirect('users')->with('error', "Something went wrong");
    }


    public function editUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('users.edit', compact('user'));
    }




    public function updateUser(Request $request)
    {

        $existing = User::where('email', $request->email)->where('id', '!=', $request->id)->first();

        if ($existing) {

            return redirect()->back()->with('error', "Email already exists")->withInput();
        }

        $user = User::find($request->id);
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->profile_avatar_remove != null) {

            $avatar = url('assets/media/users/default.jpg');

            $user->avatar = $avatar;
        } elseif ($request->file('profile_avatar')) {

            $imageFileName = time() . '' . rand(10, 10000) . '.' . $request->file('profile_avatar')->getClientOriginalExtension();

            $directory = public_path('storage/users');

            if (!File::isDirectory($directory)) {

                File::makeDirectory($directory, 0755, true, true);
            }

            $imagePath = $directory . '/' . $imageFileName;

            $avatar = asset('/storage/users') . '/' . $imageFileName;

            request()->profile_avatar->move(public_path('storage/users'), $imageFileName);

            $user->avatar = $avatar;
        }

        if ($user->save()) {

            return redirect('users')->with('success', "User updated successfully");
        } else {

            return redirect('edit/user')->with('error', "Something went wrong");
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function contact()
    {
        return view('contact');
    }
}
