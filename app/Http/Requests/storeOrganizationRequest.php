<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeOrganizationRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:organizations,name',
            'slug' => 'nullable|string|max:255|unique:organizations,slug',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'logo_path' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'owner_id' => 'nullable|exists:users,id',
        ];
    }
}
