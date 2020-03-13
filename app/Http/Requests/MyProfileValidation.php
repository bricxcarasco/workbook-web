<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MyProfileValidation extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'business_name' => 'bail|required',
            'business_type' => 'bail|required',
            'email_address' => 'bail|required|email',
            'mailing_address' => 'bail|required',
            'profile_desc' => 'bail|required',
            'facebook' => 'bail|required',
            'twitter' => 'bail|required',
            'instagram' => 'bail|required',
            'affiliation' => 'bail|required',
            'image_upload' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }

    
}
