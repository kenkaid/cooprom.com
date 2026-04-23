<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::with(['culturalSector', 'roles'])->get();
    }

    public function findByUuid($uuid)
    {
        return User::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($uuid, array $data)
    {
        $user = $this->findByUuid($uuid);
        $user->update($data);
        return $user;
    }

    public function delete($uuid)
    {
        $user = $this->findByUuid($uuid);
        return $user->delete();
    }
}
