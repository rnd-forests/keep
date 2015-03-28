<?php namespace Keep\Http\Requests;

class EditUserProfileRequest extends Request {

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
            'name' => 'required|max:255',
            'birthday' => 'date|before:now|before:6 years ago',
            'address' => 'max:300',
            'website' => 'url',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'about' => 'max:2500',
		];
	}

}
