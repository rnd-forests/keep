<?php namespace Keep\Http\Requests;

class MemberAssignmentRequest extends Request {

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
            'user_list'       => 'required',
            'priority_level'  => 'required',
            'starting_date'   => 'required|date',
            'finishing_date'  => 'required|date|after:starting_date'
        ];
    }

}
