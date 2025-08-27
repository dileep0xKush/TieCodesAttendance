<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormValidateRequest ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Validate extends FormValidateRequest
{
    public function __construct()
    {

    }

    public function validate(Request $request, $rules, $messages)
    {
        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() ) {
            return (object)[
                "status_code" => 400,
                "message"     => "The given data was invalid.",
                "error"       => $validator->errors(),
                "data"        => null
            ];
        }
        return null;
    }
}
