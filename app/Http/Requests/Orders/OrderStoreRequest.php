<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'countries' => 'required|array|min:1',
            'countries.*' => 'numeric|exists:countries,id',
            'universities' => 'nullable|array|min:1',
            'universities.*' => 'numeric|exists:universities,id',
            'specializations' => 'required|array|min:1',
            'specializations.*' => 'string|max:255',
            'budget' => 'required|numeric|min:1500|max:9999999',
        ];
    }
}
