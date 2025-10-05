<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
         \Log::info('=== STOREREQUEST SE ESTÁ EJECUTANDO ===');
    \Log::info('Datos recibidos:', $this->all());
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed',
            'categories' => 'sometimes|array',
            'categories.*' => 'exists:categories,id'
        ];
    }
}
