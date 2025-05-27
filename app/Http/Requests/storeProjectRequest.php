<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:start_date',
            'status' => 'required|in:pending,active,completed,canceled',
            'priority' => 'required|in:low,medium,high',
        ];
    }


    public function messages(): array
    {
        return [
            'start_date.date_format' => 'The start date must be in the format YYYY-MM-DD.',
            'end_date.date_format' => 'The end date must be in the format YYYY-MM-DD.',
        ];
    }
}
