<?php

namespace App\Http\Requests\Admin\Universities;

use Illuminate\Foundation\Http\FormRequest;

class UniversityUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'sometimes|nullable|url',
            'site_url' => 'sometimes|nullable|url',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
