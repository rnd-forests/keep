<?php

namespace Keep\Http\Requests;

class RegistrationRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'name' => 'required|alpha_spaces|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
