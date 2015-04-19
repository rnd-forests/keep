<?php namespace Keep\Http\Requests;

class GroupAssignmentRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'assignment_name' => 'required|min:3',
            'title'           => 'required|min:3',
            'content'         => 'required|min:5',
            'group_list'      => 'required',
            'priority_level'  => 'required',
            'starting_date'   => 'required|date',
            'finishing_date'  => 'required|date|after:starting_date'
        ];
    }

}
