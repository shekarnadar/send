<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateCampaignRequest extends FormRequest
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
                'name' => 'required|max:30',
                'description' => 'required',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ];

        return $rule;
    }

    public function messages() {
        return [
            'name.required' => 'The name field is required.',
            'price.regex' => 'The price format is not valid.',            
        ];
    }
}
