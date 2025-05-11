<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Subscription;

use App\Models\Subscription;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class SignUpRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s]+$/',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s]+$/',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique((new Subscription())->getTable(), 'email'),
            ],
            'role' => [
                'required',
                'string',
                'max:255',
                Rule::in(['student', 'teacher', 'parent', 'private_tutor']),
            ],
        ];
    }

    /**
     * Handles a failed validation attempt by throwing an HTTP response exception.
     *
     * @param  Validator  $validator  The validator instance containing validation errors.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
