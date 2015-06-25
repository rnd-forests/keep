<?php

namespace Keep\Http\Requests;

class UserGroupRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|between:4,255',
        ];
    }
}
