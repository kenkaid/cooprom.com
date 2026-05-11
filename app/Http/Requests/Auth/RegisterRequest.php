<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'role_type' => 'required|in:artiste,organisation,individuel',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cultural_sector_id' => 'required_unless:role_type,individuel|exists:cultural_sectors,id',
            'other_sector' => 'required_if:role_type,individuel|nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
        ];

        // Validation additionnelle pour "AUTRES"
        if ($this->role_type !== 'individuel' && $this->cultural_sector_id) {
            $selectedSector = \App\Models\CulturalSector::find($this->cultural_sector_id);
            if ($selectedSector && strtoupper($selectedSector->name) === 'AUTRES') {
                $rules['other_sector'] = 'required|string|max:255';
            }
        }

        if ($this->role_type === 'artiste') {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'habitation_place' => 'required|string|max:255',
                'burida_number' => 'required|string|size:4',
                'cni_number' => 'required|string|max:255',
                'pseudonym' => 'required|string|max:255',
            ]);
        } elseif ($this->role_type === 'organisation') {
            $rules = array_merge($rules, [
                'company_name' => 'required|string|max:255',
                'manager_name' => 'required|string|max:255',
                'registration_number_mc' => 'required|string|max:255',
                'implementation_place' => 'required|string|max:255',
            ]);
        } elseif ($this->role_type === 'individuel') {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'habitation_place' => 'required|string|max:255',
                'cnps_number' => 'nullable|string|max:255',
                'profession' => 'required|string|max:255',
            ]);
        }

        // Validation des attributs dynamiques
        $dynamicAttributes = $this->getDynamicAttributes();
        foreach ($dynamicAttributes as $attribute) {
            if ($attribute->is_required) {
                $rules['attrs.' . $attribute->name] = $attribute->validation_rules ?? 'required';
            } elseif ($attribute->validation_rules) {
                $rules['attrs.' . $attribute->name] = 'nullable|' . $attribute->validation_rules;
            }
        }

        return $rules;
    }

    protected function getDynamicAttributes()
    {
        $role = $this->role_type;
        $sectorId = $this->cultural_sector_id;

        if ($role === 'individuel') {
            return \App\Models\Attribute::where(function ($query) use ($role) {
                $query->whereNull('allowed_roles')
                      ->orWhere('allowed_roles', 'like', '%' . $role . '%');
            })->whereDoesntHave('culturalSectors')->get();
        }

        return \App\Models\Attribute::where(function ($query) use ($role) {
                $query->whereNull('allowed_roles')
                      ->orWhere('allowed_roles', 'like', '%' . $role . '%');
            })
            ->where(function ($query) use ($sectorId) {
                $query->whereDoesntHave('culturalSectors')
                      ->orWhereHas('culturalSectors', function ($q) use ($sectorId) {
                          $q->where('cultural_sectors.id', $sectorId);
                      });
            })
            ->get();
    }
}
