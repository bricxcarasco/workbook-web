<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRegularJobAddValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image_upload' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'bail|required|date',
            'event_time' => 'bail|required',
            'title' => 'bail|required|max:100',
            'details' => 'bail|required|max:250',
            'type' => 'bail|required',
            'tags' => 'bail|required',
            'min_offer' => 'bail|required|numeric',
            'max_offer' => 'bail|required|numeric',
            'experience' => 'bail|required',
            'municipality' => 'bail|max:100',
            'barangay' => 'bail|max:100',
            'postal' => 'bail|max:10',
            'slots' => 'bail|required|numeric',
            'dti' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
