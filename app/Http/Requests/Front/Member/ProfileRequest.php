<?php

namespace App\Http\Requests\Front\Member;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = auth()->user();
        $userId = $user->id;

        $rules = [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'phone_number' => 'required|string|max:20',
            'habitation_place' => 'required|string|max:255',
            'cultural_sector_id' => ($user->role_type === 'individuel' ? 'nullable|string|max:255' : 'required|exists:cultural_sectors,id'),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        if ($user->role_type === 'artiste') {
            $rules = array_merge($rules, [
                'burida_number' => 'required|string|size:4',
                'cni_number' => 'required|string|max:255',
                'pseudonym' => 'required|string|max:255',
            ]);
        } elseif ($user->role_type === 'organisation') {
            unset($rules['name'], $rules['last_name']);
            $rules = array_merge($rules, [
                'company_name' => 'required|string|max:255',
                'manager_name' => 'required|string|max:255',
                'registration_number_mc' => 'required|string|max:255',
                'implementation_place' => 'required|string|max:255',
            ]);
        } elseif ($user->role_type === 'individuel') {
            $rules = array_merge($rules, [
                'cnps_number' => 'nullable|string|max:255',
                'profession' => 'required|string|max:255',
            ]);
        }

        // Validation additionnelle pour "AUTRES" (Artistes/Organisations)
        if ($user->role_type !== 'individuel' && $this->cultural_sector_id) {
            $selectedSector = \App\Models\CulturalSector::find($this->cultural_sector_id);
            if ($selectedSector && strtoupper($selectedSector->name) === 'AUTRES') {
                $rules['other_sector'] = 'required|string|max:255';
            }
        }

        // Validation des attributs dynamiques EAV
        $dynamicAttributes = app(\App\Services\Front\Member\ProfileService::class)->getAttributesForUser($user);
        foreach ($dynamicAttributes as $attribute) {
            $key = 'attributes.' . $attribute->uuid;
            if ($attribute->required) {
                $rules[$key] = $attribute->validation_rules ?? 'required';
            } elseif ($attribute->validation_rules) {
                $rules[$key] = 'nullable|' . $attribute->validation_rules;
            } else {
                $rules[$key] = 'nullable';
            }
        }

        return $rules;
    }
}
