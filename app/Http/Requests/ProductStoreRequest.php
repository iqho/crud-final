<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'in:0,1',
        ];
    }
}
