<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // バリデーションの内容を設定
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'integer', 'between:1,1000000'],
        ];
    }
}
