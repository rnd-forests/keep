<?php

namespace Keep\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function validateAdmin()
    {
        return auth()->user()->hasRole('admin');
    }
}
