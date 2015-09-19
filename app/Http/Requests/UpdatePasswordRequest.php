<?php

namespace Keep\Http\Requests;

class UpdatePasswordRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ];
    }
}
