<?php

namespace Keep\Http\Requests;

class UpdateNameRequest extends AbstractRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_username' => 'required',
            'new_username' => 'required|different:old_username|max:255',
        ];
    }
}
