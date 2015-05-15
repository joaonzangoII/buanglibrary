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
		$method = Request::method();
		$rules = [];
		if($method=="POST")
		{
			$rules = [
				'fname'  =>"required",
				'lname'  =>"required",
				'id_number'  =>"required|numeric|digits:13|unique:users",
				'address'  =>"required",
				'email'  =>"required|email|unique:users",
				'password'  =>"required|min:6|confirmed",
				'password_confirmation'  =>"required|min:6",
				'phone'  =>"required|numeric|digits:10|digits:10",
			];
	  }
	  else{
      $rules = [
				'fname'  =>"required",
				'lname'  =>"required",
				'id_number'  =>"required|numeric|digits:13|unique:users,id",
				'address'  =>"required",
				'email'  =>"required|email|unique:users,id",
				'phone'  =>"required|numeric|digits:10|digits:10",
			];
	  }

	 return $rules;
	}
}
