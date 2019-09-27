<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsUpdateRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:160',
            'site_keywords' => 'nullable|string|max:255',
            'allow_notifications' => 'required|string|in:1,0',
            'allow_friends' => 'required|string|in:1,0',
            'site_open' => 'required|in:1,0',
        ];
    }
}
