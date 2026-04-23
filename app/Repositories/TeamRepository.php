<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    public function all()
    {
        return Team::all();
    }

    public function findByUuid($uuid)
    {
        return Team::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data)
    {
        return Team::create($data);
    }

    public function update($uuid, array $data)
    {
        $team = $this->findByUuid($uuid);
        $team->update($data);
        return $team;
    }

    public function delete($uuid)
    {
        $team = $this->findByUuid($uuid);
        return $team->delete();
    }
}
