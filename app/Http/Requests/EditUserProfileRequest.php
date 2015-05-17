<?php namespace Keep\Http\Requests;

class EditUserProfileRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'location'         => 'max:300',
            'bio'              => 'max:2500',
            'website'          => 'url',
            'phone'            => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'twitter_username' => 'max:255',
            'github_username'  => 'max:255'
        ];
    }

}
