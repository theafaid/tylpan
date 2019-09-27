<?php

namespace App\Http\Requests\Tasks;

//use App\Rules\ValidTaskBased;
use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! $this->user()->isDefaultUser() ;

        // && if delegate > must be order delegator
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task' => 'required|string|max:255',
            'task_for' => 'required|numeric|exists:users,id',
        ];
    }
}
