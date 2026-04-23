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
        return CulturalSector::all();
    }
}
