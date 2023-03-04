<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateProductRequest extends FormRequest
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
                'pname' => 'required|max:100',
                'description' => 'required',
                'pprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'category' => 'required',

                // 'first_name' => 'required|max:30',
                // 'last_name' => 'required|max:30',
                // 'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:30',
                // 'phone' => 'required|numeric|digits:10',
            ];

        return $rule;
    }

    public function messages() {
        return [
            'pname.required' => 'The name field is required.',
            'pprice.regex' => 'The price format is not valid.',  
            'pprice.required' => 'The price field is required.',
            'description.required' => 'The description field is required.',
            'category.required' => 'The category field is required.',

            // 'first_name.required' => 'The first name field is required.',
            // 'last_name.required' => 'The last name field is required.',
            // 'email.required' => 'The email field is required.',
            // 'email.regex' => 'The email is not valid.',
            // 'phone.required' => 'The phone field is required.',
            // 'phone.digits' => 'The phone must be 10 digits.',
            // 'phone.numeric' => 'The phone must be numeric value.',
        ];
    }
}
