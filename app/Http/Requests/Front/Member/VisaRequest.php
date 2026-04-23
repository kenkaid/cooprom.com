<?php

namespace App\Http\Requests\Front\Member;

use Illuminate\Foundation\Http\FormRequest;

class VisaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country' => 'required|string|max:255',
            'visa_type' => 'required|string|max:255',
            'travel_id' => 'nullable|exists:travels,uuid',
            'required_documents' => 'nullable|string',
        ];
    }
}
