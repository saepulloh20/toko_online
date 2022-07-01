<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
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
            'race_name' => 'exists:products,name',
            'type' => 'exists:products,jenis',
            'distance' => 'required|string',
            'average_pace' => 'required|string',
            'time' => 'required|string',
            'status' => 'nullable',
            'photos' => 'required|image',

        ];
    }
}
