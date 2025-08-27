<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{

    public function register(Request $request)
    {
        // dd($request->all());
        $existing = User::where('email', $request->email)->first();

        if ($existing) {

            return redirect()->back()->with('error', __("lang.Email already exists"))->withInput();
        }

        $employee = new User;
        $employee->full_name = $request->Username;
        $employee->email = $request->email;
        $employee->joining_date = Carbon::now()->format('y-m-d');
        $employee->phone = $request->phone;
        $employee->type = 'employee';
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->dob = $request->dob;
        $employee->password = Hash::make($request->password);

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

        $employee->avatar = $avatar;

        if ($employee->save()) {

            return redirect('/')->with('success', "Signup successfully");
        }

        return redirect('create/emp')->with('error', "Something went wrong");
    }


    public function employees(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('type', '!=', 'superadmin')->latest()
                ->get();

            return DataTables::of($data)->make(true);
        }

        return view('emp.all');
    }


    public function createEmp()
    {
        return view('emp.create');
    }



    public function addEmp(Request $request)
    {
        $existing = User::where('email', $request->email)->first();

        if ($existing) {

            return redirect()->back()->with('error', "Email already exists")->withInput();
        }

        $employee = new User;
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->joining_date = Carbon::now()->format('y-m-d');
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->type = 'employee';

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

        $employee->avatar = $avatar;

        if ($employee->save()) {

            return redirect('employees')->with('success', "Employee created successfully");
        }

        return redirect('create/emp')->with('error', "Something went wrong");
    }


    public function editEmp($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('emp.edit', compact('user'));
    }


    public function updateEmp(Request $request)
    {
        // dd($request->all());
        $existing = User::where('email', $request->email)->where('slug', '!=', $request->slug)->first();

        if ($existing) {

            return redirect()->back()->with('error', "Email already exists")->withInput();
        }

        $employee = User::where('slug', $request->slug)->first();
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->designation = $request->designation;

        if ($request->profile_avatar_remove != null) {

            $avatar = url('assets/media/users/default.jpg');

            $employee->avatar = $avatar;
        } elseif ($request->file('profile_avatar')) {

            $imageFileName = time() . '' . rand(10, 10000) . '.' . $request->file('profile_avatar')->getClientOriginalExtension();

            $directory = public_path('storage/users');

            if (!File::isDirectory($directory)) {

                File::makeDirectory($directory, 0755, true, true);
            }

            $imagePath = $directory . '/' . $imageFileName;

            $avatar = asset('/storage/users') . '/' . $imageFileName;

            request()->profile_avatar->move(public_path('storage/users'), $imageFileName);

            $employee->avatar = $avatar;
        }

        if ($employee->save()) {

            return redirect('employees')->with('success', "Employee updated successfully");
        } else {

            return redirect('edit/emp')->with('error', "Something went wrong");
        }
    }



    public function deleteEmp($slug)
    {
        $user = User::where('slug', $slug)->first();

        $user->email .= "-removed-" . $user->id;

        if ($user->save()) {

            $user->delete();

            return redirect('employees')->with('success', "User deleted successfully");
        }

        return redirect('employees')->with('error', "Something went wrong");
    }
}
