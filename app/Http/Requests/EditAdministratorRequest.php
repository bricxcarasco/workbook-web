<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdministratorRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'password' => 'bail|required',
            'image_upload' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
