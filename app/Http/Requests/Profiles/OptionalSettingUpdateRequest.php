<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class OptionalSettingUpdateRequest extends FormRequest
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
            // related to education
            'certifications' => 'nullable|sometimes|array',
            'secondary_school_grade' => 'nullable|numeric|min:50|max:100',
            'secondary_school_graduated_date' => 'nullable|sometimes|date',
            'college_graduated_date' => 'nullable|sometimes|date',
            // related to personality
            'avatar' => 'nullable|sometimes|string|url|max:255',
            'social_links' => 'nullable|sometimes|array|min:1',
            'social_links.*' => 'nullable|url|string',
            'social_status' => 'nullable|sometimes|string|max:255',
            'health_status' => 'nullable|sometimes|string|max:255',
            // related to skills others
            'speaking_languages' => 'nullable|sometimes|array|min:1',
            'speaking_languages.*' => 'required|string|min:2',
            'additional_details' => 'nullable|string|max:200000',
        ];
    }
}
