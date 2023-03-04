<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateClientRequest extends FormRequest
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

        if(!empty(request()->id)){
           //exit('tesllt');
            return [
                    /*'email' => 'required|check_email_format|unique:client_admins,email,'.$this->id,
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'phone' => 'required|phone_format|unique:client_admins,phone,'.$this->id,*/
                    'gstin'=>'nullable|min:15|max:15|unique:clients,gstin,'.$this->id,
                    'pan'=>'nullable|min:10|max:10|unique:clients,pan,'.$this->id,
                ];
        } else {
            return [
                    // 'postal_code' => 'required',
                    'company_name' => 'required',
                    'gstin'=>'nullable|min:15|max:15|unique:clients,gstin',
                    'pan'=>'nullable|min:10|max:10|unique:clients,pan,'.$this->id,
                    // 'address_line_1' => 'required',
                    // 'address_line_2' => 'required',

                ];
        }

        return $rule;
    }

    public function messages() {

        return [
            // 'email.check_email_format' => 'The email should be valid.',
            // 'email.unique' => 'The email has been already taken by another user.',
            // 'phone.phone_format' => 'The phone number should be valid.',
            // 'phone.unique' => 'The phone number has been already taken by another user.',
            'company_name.required' => 'Company name is required.',
            'gstin.min'=>'Gst should be 15 characters',
            'gstin.max'=>'Gst should be 15 characters',
            'gstin.unique'=>'Gst already taken',
            'pan.digits'=>'Pan should be 10 digits',
            'pan.unique'=>'Pan already taken',
            'address_line_1.required'=>'Address are required',

        ];
    }
}
