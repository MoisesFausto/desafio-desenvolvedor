<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreCounterProductsRequest extends FormRequest
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
            'file' => 'required|file|mimes:csv,xlsx,xls,txt',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Field is required.',
            'file.file' => 'File must be a file.',
            'file.mimes' => 'File must be a file of type: CSV, XLSX, XLS.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->errors()
        ], Response::HTTP_INTERNAL_SERVER_ERROR)));
    }
}
