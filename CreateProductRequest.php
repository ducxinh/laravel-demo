<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        $rules = [];

        switch ($this->method()) {
            case 'POST':
                // Rules for creating a product
                $rules = [
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'price' => 'required|numeric|min:0',
                    'stock' => 'required|integer|min:0',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                // Rules for updating a product
                $rules = [
                    'name' => 'sometimes|required|string|max:255',
                    'description' => 'nullable|string',
                    'price' => 'sometimes|required|numeric|min:0',
                    'stock' => 'sometimes|required|integer|min:0',
                ];
                break;

            case 'GET':
                // Rules for listing products
                $rules = [
                    'page' => 'integer|min:1',
                    'per_page' => 'integer|min:1|max:100',
                ];
                break;
        }

        return $rules;
    }
}
