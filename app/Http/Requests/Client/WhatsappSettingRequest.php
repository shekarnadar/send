<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class WhatsappSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
                'token' => 'required',
                'url'=>'required'

            ];
        return $rule;
    }
    public function messages() {

        return [
            'template_name.required' => 'Template name is required.',
            'broadcat_name.required' => 'Broadcast name is required.',
            'token' => 'Token is required.',
            'url' => 'Url is required'
           
        ];
    }
}
