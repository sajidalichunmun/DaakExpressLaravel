<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest
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
            'menu_id' => 'nullable',
            'name' => 'required|string|min:1|max:50',
            'controller' => 'nullable|string|min:0|max:100',
            'icon' => 'nullable|string|min:0|max:50',
            'url' => 'nullable|string|min:0|max:50',
            'sort_order' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
            'mega' => 'nullable',
        ];
    }
	
	/**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->all();
        return $data;
    }
}
