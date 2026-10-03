<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuItemRequest extends FormRequest
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
        $itemId = $this->route('menu_item')?->id ?? $this->route('menu_item') ?? $this->input('id');

        return [
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('menu_items', 'slug')->ignore($itemId)],
            'description' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_vegetarian' => ['nullable', 'boolean'],
            'is_vegan' => ['nullable', 'boolean'],
            'is_spicy' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_available' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'variations' => ['nullable', 'array'],
            'variations.*.id' => ['nullable', 'integer'],
            'variations.*.name' => ['required_with:variations', 'string', 'max:255'],
            'variations.*.price' => ['required_with:variations', 'numeric', 'min:0'],
            'addons' => ['nullable', 'array'],
            'addons.*.id' => ['nullable', 'integer'],
            'addons.*.name' => ['required_with:addons', 'string', 'max:255'],
            'addons.*.price' => ['required_with:addons', 'numeric', 'min:0'],
        ];
    }
}
