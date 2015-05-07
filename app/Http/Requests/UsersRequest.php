<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request {

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
			'fname'  =>"required",
			'lname'  =>"required",
			'address'  =>"required",
			'email'  =>"required|email|unique:users",
			'password'  =>"required|min:6",
			'phone'  =>"required",
		];
	}

}