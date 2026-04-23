<?php

namespace App\Http\Requests\Front\Member;

use Illuminate\Foundation\Http\FormRequest;

class ProductionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'attachment_file' => 'nullable|file|mimes:pdf,doc,docx,txt,ppt,pptx|max:12288',
        ];
    }
}
