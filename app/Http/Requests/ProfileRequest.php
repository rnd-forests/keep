<?php

namespace Keep\Http\Requests;

class ProfileRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'location' => 'max:255',
            'bio' => 'max:2500',
            'website' => 'url|active_url',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'twitter_username' => 'max:255',
            'github_username' => 'max:255',
            'google_username' => 'max:255',
            'facebook_username' => 'max:255',
        ];
    }
}
