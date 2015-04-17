<?php namespace Keep\Http\Requests;

class AddUsersToGroupRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'group_new_users' => 'required'
        ];
    }

}
