<?php namespace Keep\Http\Requests;

class EditUserProfileRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required|max:255',
            'address' => 'max:300',
            'website' => 'url',
            'phone'   => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'about'   => 'max:2500',
        ];
    }

}
