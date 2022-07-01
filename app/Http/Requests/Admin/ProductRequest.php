<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'event_start' => 'required|max:255',
            'event_end' => 'required|max:255',
            'active_start' => 'required|max:255',
            'active_end' => 'required|max:255',
            'jenis' => 'required|string',
            'lokasi' => 'required|string',
            'users_id' => 'required|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'description' => 'required',
        ];
    }
}
