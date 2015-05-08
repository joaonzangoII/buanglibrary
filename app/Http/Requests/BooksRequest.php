<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BooksRequest extends Request {

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
		  "title" =>"required",
			"name"     =>"required",
			"alt" => "required",
			// "image" => "required|mimes:jpeg,bmp,png",
			"image" => "required|image",
			"title"     =>"required",
			"author"     =>"required",
			"edition"     =>"required",
			"isbn"     =>"required|numeric|digits:13",
			"total_num_books"     =>"required",
			"year"     =>"required|numeric|digits:4|digits:4",
			"book_category_id"     =>"required",
			"price"     =>"required|numeric",
			"published_at"     =>"required",
		];
	}

}
