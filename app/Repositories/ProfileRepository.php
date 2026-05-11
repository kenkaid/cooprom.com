<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\CulturalSector;

class ProfileRepository
{
    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function getAllSectors()
    {
        $user = auth()->user();
        $query = CulturalSector::query();

        if ($user && $user->role_type) {
            $query->where(function ($q) use ($user) {
                $q->where('allowed_roles', 'LIKE', '%' . $user->role_type . '%')
                  ->orWhereNull('allowed_roles')
                  ->orWhere('allowed_roles', '');
            });
        }

        return $query->get();
    }
}
