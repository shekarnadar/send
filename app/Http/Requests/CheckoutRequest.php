<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidPinCode;


class CheckoutRequest extends FormRequest
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
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50',
                'phone' => 'required|numeric|digits:10',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'postal_code'=> [
                    'required',
                    'numeric',
                    new ValidPinCode]
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
            'address.required' => 'The address field is required.',
            'postal_code.required' =>'The postal code filed is required',
            'postal_code.digits' => 'The postal code must be 6 digits.',
            'postal_code.numeric' => 'The postal code must be numeric value.',
        ];
    }
}
