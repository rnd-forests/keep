<?php

namespace Keep\Http\Requests;

class UpdatePasswordRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed|min:6',
        ];
    }
}
