<?php namespace Keep\Http\Requests;

class TaskRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'priority_level' => 'required',
            'starting_date' => 'required|date',
            'finishing_date' => 'required|date|after:starting_date'
		];
	}

}
