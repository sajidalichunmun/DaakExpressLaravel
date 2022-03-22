<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RolesFormRequest extends FormRequest
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
        $rules = [
                'role_name' => 'required|string|min:1|max:50',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['role_name', 'created_by', 'updated_by']);

        return $data;
    }

}