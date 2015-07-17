<?php

namespace Keep\OAuth\Contracts;

interface ExtractableProviderData
{
    public function extractAndUpdateProfile($user, $data);
}