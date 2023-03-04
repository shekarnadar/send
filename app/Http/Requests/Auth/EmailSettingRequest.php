<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'clientadmin_email' => 'required|check_email_format',
                'clientadmin_password' => 'required|max:30',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:30',

            ];
        return $rule;
    }

    public function messages() {

        return [
            'clientadmin_email.required' => 'email name is required.',
            // 'clientadmin_email.check_email_format' => 'The email should be valid.',
            'clientadmin_password.required' => 'password is required.',
            // 'email.unique' => 'The email has been already taken by another user.',
            // 'phone.phone_format' => 'The phone number should be valid.'
            // 'phone.unique' => 'The phone number has been already taken by another user.',
            // 'gstin.min'=>'Gst should be 15 characters',
            // 'gstin.max'=>'Gst should be 15 characters',
            // 'gstin.unique'=>'Gst already taken',
            // 'pan.digits'=>'Pan should be 10 digits'
            //'pan.unique'=>'Pan should be 10 digits'
        ];
    }
}
