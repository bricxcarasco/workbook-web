<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdministratorRequest extends FormRequest
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
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required',
            'image_upload' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
