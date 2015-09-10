<?php

namespace Keep\Http\Requests;

class NotificationRequest extends AbstractRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject' => 'required|min:3',
            'body'    => 'required|min:5',
            'type'    => 'required',
        ];
    }
}
