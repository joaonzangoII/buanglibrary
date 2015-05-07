<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookingsRequest extends Request {

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
			// "book_id" =>"required",
			"num_booked" =>"required|numeric",
			// "amount" =>"required|decimal",
			"start_date" =>"required",
			"end_date" =>"required",
		];
	}

}
