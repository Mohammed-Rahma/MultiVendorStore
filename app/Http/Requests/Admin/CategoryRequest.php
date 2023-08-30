<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function  rules($id=0): array
    {

        return [
         'name' => ['required', Rule::unique('categories' , 'name')->ignore($id)],
         'parent_id'=>'nullable|exists:categories,id',
         'image'=>'mimes:jpeg,jpg,png | max : 1000 ',
         'status'=>'in:active,archived',
         'description'=>['nullable' , 'requierd']
        ];
    }
}
