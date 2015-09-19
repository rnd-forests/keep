<?php

namespace Keep\Http\Requests;

class TaskRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'priority_level' => 'required',
            'starting_date' => 'required|date',
            'finishing_date' => 'required|date|after:starting_date',
        ];
    }
}
