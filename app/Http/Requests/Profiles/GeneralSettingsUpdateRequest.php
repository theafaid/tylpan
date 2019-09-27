<?php

namespace App\Http\Requests\Profiles;

use App\Rules\ValidCountry;
use Illuminate\Validation\Rule;
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'sometimes|nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'sometimes|nullable|string|max:255|min:6|confirmed',
            'country_id' => ['required', 'numeric', new ValidCountry],
            'gender' => 'required|nullable|string|in:male,female',
            'age' => 'required|numeric|max:70',
            'phone_number' => 'required|string|max:17|min:8',
        ];
    }
}
