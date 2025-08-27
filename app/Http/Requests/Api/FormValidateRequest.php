<?php

namespace App\Http\Requests\Api;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
abstract class FormValidateRequest
{
    abstract public function validate(Request $request, $rules, $messages);
}