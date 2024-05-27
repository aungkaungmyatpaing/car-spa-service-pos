<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'duration_id' => 'required|integer|exists:durations,id',
            'size_id' => 'required|integer|exists:sizes,id',
            'category_id' => 'required|integer|exists:categories,id',
            'note' => 'nullable|string'
        ];

        // Check if subcategories exist for the provided category_id
        $category = Category::find($this->category_id);
        if ($category && $category->subcategories->isNotEmpty()) {
            // If subcategories exist, make sub_category_id required
            $rules['sub_category_id'] = 'required|integer|exists:sub_categories,id';
        } else {
            // If no subcategories exist, make sub_category_id nullable
            $rules['sub_category_id'] = 'nullable|integer|exists:sub_categories,id';
        }

        return $rules;
    }
}
