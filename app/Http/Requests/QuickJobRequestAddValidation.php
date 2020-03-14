<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuickJobRequestAddValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request' => 'bail|required',
            'event_date' => 'bail|required',
            'event_time' => 'bail|required',
            'location' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
