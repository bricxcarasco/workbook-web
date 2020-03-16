<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyQuickJobValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image_upload' => 'bail|required|mimes:pdf,docx,doc',
            'identification' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'bail|required|date',
            'message' => 'bail|required'
        ];
    }
}
