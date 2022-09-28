<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class DatePushgroundRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	protected function prepareForValidation()
	{
		
		if (!$this->has('date')) {
			$this->replace([
				'date' => date('Y-m-d', strtotime('yesterday'))
			]);
		}
		
	}
	
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json($validator->errors(), 403));
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'date' => ['date_format:Y-m-d']
		];
	}
	
	public function messages(): array
	{
		return [
			'date.date_format' => 'Formato de fecha invalido',
		];
	}
}