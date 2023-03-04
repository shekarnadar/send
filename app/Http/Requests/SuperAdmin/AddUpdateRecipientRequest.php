<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Recipient;
use App\Rules\ValidPinCode;


class AddUpdateRecipientRequest extends FormRequest
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
            $checkUser = Recipient::where('id',request()->id)->first();
            $email = $checkUser['email'];
            if($checkUser['email'] == request()->email){
                $is_set = 1;
            } else{
                $is_set = 0;
            }
            if($checkUser['phone'] == request()->phone){
                $is_phone = 1 ;
            }else{
                 $is_phone = 0 ;
            }
            if($is_phone == 0){
                 return [
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'phone' => 'required|numeric|digits:10|unique:recipients,phone',
                    'postalcode'=> [
                        'nullable',
                        'numeric',
                        new ValidPinCode
                    ]
                ];
            }if($is_set == 0){
                 return [
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50|unique:recipients,email',
                    'postalcode'=> [
                        'nullable',
                        'numeric',
                        new ValidPinCode
                    ]
                  
                ];
            }
                else{
                 return [
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'postalcode'=> [
                        'nullable',
                        'numeric',
                        new ValidPinCode
                    ]
                    
                ];
            }
               
            
        }else{
            return [
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:30|unique:recipients,email',
                'phone' => 'required|numeric|digits:10|unique:recipients,phone',
                'postalcode'=> [
                        'nullable',
                        'numeric',
                        new ValidPinCode
                    ]
            ];
        }
        

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
            'postalcode.digits' => 'The postal code must be 6 digits.',
            'postalcode.numeric' => 'The postal code must be numeric value.',
        ];
    }
}
