<?php

namespace App\Repositories;

use App\Models\CulturalSector;

class CulturalSectorRepository
{
    public function all()
    {
        return CulturalSector::all();
    }

    public function findByUuid($uuid)
    {
        return CulturalSector::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data)
    {
        return CulturalSector::create($data);
    }

    public function update($uuid, array $data)
    {
        $sector = $this->findByUuid($uuid);
        $sector->update($data);
        return $sector;
    }

    public function delete($uuid)
    {
        $sector = $this->findByUuid($uuid);
        return $sector->delete();
    }
}
