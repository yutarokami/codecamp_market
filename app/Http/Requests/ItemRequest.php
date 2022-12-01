<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'category' => ['required'],
            'price' => ['required', 'digits_between:1,7'],
            'image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'dimensions:min_width:50,min_height:50,max_width:1000,max_height:1000',
            ],
        ];
    }
}
