<?php

namespace Keep\Core\OAuth\Contracts;

interface ExtractableProvider
{
    /**
     * Extract and update user profile from data returned from provider.
     *
     * @param $user
     * @param $data
     * @return mixed
     */
    public function extractAndUpdate($user, $data);
}
