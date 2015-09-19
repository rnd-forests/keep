<?php

namespace Keep\Http\Requests;

class GroupRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'name' => 'required|between:4,255',
        ];
    }
}
