<?php

namespace Keep\Http\Requests;

class SignInRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
