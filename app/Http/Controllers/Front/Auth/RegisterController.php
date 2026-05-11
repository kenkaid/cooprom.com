<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CulturalSector;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $sectors = CulturalSector::with('attributes')->get();
        // Attributs globaux par rôle (non liés à un secteur spécifique)
        $globalAttributes = Attribute::whereDoesntHave('culturalSectors')->orderBy('order_column')->get();

        return view('front.auth.register', compact('sectors', 'globalAttributes'));
    }

    public function register(RegisterRequest $request)
    {
        $userData = [
            'role_type' => $request->role_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cultural_sector_id' => $request->role_type === 'individuel' ? null : $request->cultural_sector_id,
            'other_sector' => $request->other_sector,
            'phone_number' => $request->phone_number,
            'uuid' => (string) \Illuminate\Support\Str::uuid(), // Supposant que BaseModel ou un trait ne le fait pas déjà
            'user_created_id' => 0, // Ou une valeur par défaut pour l'inscription publique
            'user_updated_id' => 0,
        ];

        if ($request->role_type === 'artiste') {
            $userData = array_merge($userData, [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'habitation_place' => $request->habitation_place,
                'burida_number' => $request->burida_number,
                'cni_number' => $request->cni_number,
                'pseudonym' => $request->pseudonym,
            ]);
        } elseif ($request->role_type === 'organisation') {
            $userData = array_merge($userData, [
                'name' => $request->company_name, // On peut mettre la raison sociale dans name
                'last_name' => $request->manager_name, // Et le manager dans last_name ou garder les champs spécifiques
                'company_name' => $request->company_name,
                'manager_name' => $request->manager_name,
                'registration_number_mc' => $request->registration_number_mc,
                'implementation_place' => $request->implementation_place,
            ]);
        } elseif ($request->role_type === 'individuel') {
            $userData = array_merge($userData, [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'habitation_place' => $request->habitation_place,
                'cnps_number' => $request->cnps_number,
                'profession' => $request->profession,
            ]);
        }

        $user = User::create($userData);

        // Enregistrement des attributs dynamiques
        if ($request->has('attrs')) {
            foreach ($request->attrs as $name => $value) {
                $attribute = Attribute::where('name', $name)->first();
                if ($attribute && $value !== null) {
                    AttributeValue::create([
                        'attribute_id' => $attribute->id,
                        'attributable_type' => User::class,
                        'attributable_id' => $user->id,
                        'value' => is_array($value) ? json_encode($value) : $value,
                    ]);
                }
            }
        }

        // Assigner le rôle adhérent par défaut
        $user->assignRole('adhérent');

        Auth::login($user);

        return redirect()->route('member.dashboard')->with('success', 'Votre compte a été créé avec succès.');
    }

    protected function getDynamicAttributes(\Illuminate\Http\Request $request)
    {
        $role = $request->role_type;
        $sectorId = $request->cultural_sector_id;

        if ($role === 'individuel') {
            return Attribute::where(function ($query) use ($role) {
                $query->whereNull('allowed_roles')
                      ->orWhere('allowed_roles', 'like', '%' . $role . '%');
            })->whereDoesntHave('culturalSectors')
                ->orderBy('order_column')
                ->get();
        }

        return Attribute::where(function ($query) use ($role) {
                $query->whereNull('allowed_roles')
                      ->orWhere('allowed_roles', 'like', '%' . $role . '%');
            })
            ->where(function ($query) use ($sectorId) {
                // Attributs soit globaux, soit liés au secteur sélectionné
                $query->whereDoesntHave('culturalSectors')
                      ->orWhereHas('culturalSectors', function ($q) use ($sectorId) {
                          $q->where('cultural_sectors.id', $sectorId);
                      });
            })
            ->orderBy('order_column')
            ->get();
    }
}
