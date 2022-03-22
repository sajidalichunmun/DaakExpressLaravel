<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MannualPodFormRequest extends FormRequest
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
            //
        ];
    }
	
	public function getData()
	{
		return $this->only(
		'AwbNo',
		'PodDate',
		'ClientCodeID',
		'CustomerName',
		'MobileNo',
		'Address1',
		'Address2',
		'Pincode',
		'SubCityID',
		'CityID',
		'StateID');
	}
}
