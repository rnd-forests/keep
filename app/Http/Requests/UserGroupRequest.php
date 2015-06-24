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
            'name' => 'required|max:255|min:4',
        ];
    }
}
