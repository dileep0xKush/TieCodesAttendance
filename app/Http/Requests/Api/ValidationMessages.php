<?php

namespace App\Http\Requests\Api;


class ValidationMessages
{
    public function userLoginMessages(): array{
        return([
            'email' => 'required',
            'password' => 'required',
        ]);
    }


    public function signupMessages(): array{
        return [
            'full_name' =>  'full_name is required',
            'email' =>  'email is required',
            'password'=>  'password is required',
            'phone' =>  'phone is required',
            'designation' =>  'designation is required',
            'dob' =>  'dob is required',
            'address' =>  'address is required',
        ];
    }
}
