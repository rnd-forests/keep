<?php

namespace Keep\OAuth\Contracts;

interface ExtractableProviderData
{
    /**
     * Extract and update user profile from data returned from provider.
     *
     * @param $user
     * @param $data
     * @return mixed
     */
    public function extractAndUpdateProfile($user, $data);
}