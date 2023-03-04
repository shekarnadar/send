<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateManagerRequest extends FormRequest
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
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:30|unique:users,email',
                'phone' => 'required|numeric|digits:10|unique:users,phone',
                // 'address_line1' => 'required',
                // 'address_line2' => 'required',
                // 'postalcode' => 'required|numeric|digits:6',
            ];

        return $rule;
    }

    public function messages() {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.regex' => 'The email is not valid.',
            'phone.required' => 'The phone field is required.',
            'phone.digits' => 'The phone must be 10 digits.',
            'phone.numeric' => 'The phone must be numeric value.',
            // 'address_line1.required' => 'The address line1 field is required.',
            // 'address_line2.required' => 'The address line2 field is required.',
            // 'postalcode.required' => 'The postal code field is required.',
            // 'postalcode.digits' => 'The postal code must be 6 digits.',
        ];
    }
}
