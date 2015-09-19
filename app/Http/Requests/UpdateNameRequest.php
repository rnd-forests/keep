<?php

namespace Keep\Http\Requests;

class UpdateNameRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'old_name' => 'required',
            'new_name' => 'required|different:old_name|max:255',
        ];
    }
}
