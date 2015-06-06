<?php
namespace Keep\Http\Requests;

class EditUserPasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password'              => 'required',
            'new_password'              => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password'
        ];
    }
}
