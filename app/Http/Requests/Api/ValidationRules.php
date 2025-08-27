<?php

namespace App\Http\Requests\Api;

use GuzzleHttp\Psr7\Request;
use Illuminate\Validation\Rule;


class ValidationRules
{
    public function userLoginRules(): array{
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }


    public function signupRules(): array{
        return [
            'full_name' => 'required',
            'email' => 'required',
            'password'=> 'required',
            'phone' => 'required',
            'designation' => 'required',
            'dob' => 'required',
            'address' => 'required',
        ];
    }
}
