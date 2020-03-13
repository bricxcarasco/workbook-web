<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeekerMyProfileValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'bail|required',
            'birth_date' => 'bail|required',
            'gender' => 'bail|required',
            'civil_status' => 'bail|required',
            'address' => 'bail|required',
            'telephone_number' => 'bail',
            'mobile_number' => 'bail',
            'email_address' => 'bail|required|email',
            'high_school' => 'bail',
            'high_school_year' => 'bail',
            'college' => 'bail',
            'college_year' => 'bail',
            'image_upload' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
