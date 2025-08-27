<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Validate;
use App\Http\Requests\Api\ValidationRules;
use App\Http\Requests\Api\ValidationMessages;
use App\Http\Resources\ErrorResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use stdClass;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    protected $validationMessages;
    protected $rules;

    public function __construct(ValidationRules $rules, ValidationMessages $validationMessages)
    {
        $this->rules = $rules;
        $this->validationMessages = $validationMessages;
    }

    public function apiJsonResponse($code, $message, $data, $error)
    {
        $response = new stdClass();
        $response->status_code = $code;
        $response->message = $message;
        $response->error = $error;
        $response->data = $data;
        return response()->json($response, $response->status_code);
    }


    public function login(Request $request, Validate $validate)
    {
        $validationErrors = $validate->validate($request, $this->rules->userLoginRules(), $this->validationMessages->userLoginMessages());
        if ($validationErrors) {
            return (new ErrorResource($validationErrors))->response()->setStatusCode(400);
        }
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if (!$user) {
                return $this->apiJsonResponse(400, "User doesn't exist.", '', "Email not found");
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->apiJsonResponse(400, "Invalid Login", '', "Incorrect password");
            }

            $data = new stdClass();
            $data->bearer_token = $user->createToken('CustomerLoginAuth')->accessToken;

            return $this->apiJsonResponse(200, "Login Success", $data, "");
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->apiJsonResponse(400, "Something went wrong", '', $e->getMessage());
        }
    }


    public function signup(Request $request, Validate $validate)
    {
        $validationErrors = $validate->validate($request, $this->rules->signupRules(), $this->validationMessages->signupMessages());
        if ($validationErrors) {
            return (new ErrorResource($validationErrors))->response()->setStatusCode(400);
        }
        try {
            $existing = User::where('email', $request->email)->first();

            if ($existing) {
                return $this->apiJsonResponse(400, "Error", '', "Email already exists");
            }

            $employee = new User;
            $employee->full_name = $request->full_name;
            $employee->email = $request->email;
            $employee->joining_date = Carbon::now()->format('y-m-d');
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->designation = $request->designation;
            $employee->password = Hash::make($request->password);
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
            $employee->save();

            return $this->apiJsonResponse(200, "success", '', "");
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->apiJsonResponse(400, "Something went wrong", '', $e->getMessage());
        }
    }
}
