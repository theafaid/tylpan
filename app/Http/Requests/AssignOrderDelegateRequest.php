<?php

namespace App\Http\Requests;

//use App\Rules\ValidDelegator;
use Illuminate\Foundation\Http\FormRequest;

class AssignOrderDelegateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // For more quick, performance i will not check if the requested delegate is already a delegator
        // if you want to, just uncomment the commented rule below.
        return [
//          'delegate_id' => ['required', 'numeric', new ValidDelegator($this->route('order')->country)],
            'delegate_id' => 'required|numeric',
        ];
    }
}
