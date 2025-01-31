<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CounterProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'FileName' => 'string|min:3',
            'RptDt' => 'date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'The :attribute must be a string.',
            'min' => 'The :attribute must be at least 3 characters.',
            'date' => 'The :attribute must be a date.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->errors()
        ], Response::HTTP_INTERNAL_SERVER_ERROR)));
    }
}
