<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        $rules = [
            'user_id' => 'required|string', // Peut être UUID ou ID
            'appointmentable_type' => 'required|string',
            'appointmentable_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];

        if ($this->isMethod('POST')) {
            $rules['appointment_date'] .= '|after:now';
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['status'] = 'required|in:scheduled,completed,cancelled';
            $rules['admin_note'] = 'nullable|string';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'L\'adhérent est obligatoire.',
            'user_id.exists' => 'L\'adhérent sélectionné est invalide.',
            'title.required' => 'Le titre est obligatoire.',
            'appointment_date.required' => 'La date du rendez-vous est obligatoire.',
            'appointment_date.after' => 'La date du rendez-vous doit être dans le futur.',
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
