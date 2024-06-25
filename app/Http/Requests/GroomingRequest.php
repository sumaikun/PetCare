<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroomingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'grooming_sessions' => 'required|array',
            'grooming_sessions.*.service' => 'required|string|max:255',
            'grooming_sessions.*.date' => 'required|date',
            'grooming_sessions.*.notes' => 'nullable|string',
        ];
    }
}
