<?php

namespace Keep\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    /**
     * Validate if the current authenticated user is administrator or not.
     *
     * @return mixed
     */
    public function validateAdmin()
    {
        return auth()->user()->hasRole(['admin', 'owner']);
    }
}
