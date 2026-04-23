<?php

namespace App\Services;

use App\Repositories\CulturalSectorRepository;
use Illuminate\Support\Facades\Auth;

class CulturalSectorService
{
    protected $culturalSectorRepository;

    public function __construct(CulturalSectorRepository $culturalSectorRepository)
    {
        $this->culturalSectorRepository = $culturalSectorRepository;
    }

    public function getAllSectors()
    {
        return $this->culturalSectorRepository->all();
    }

    public function getSector($uuid)
    {
        return $this->culturalSectorRepository->findByUuid($uuid);
    }

    public function createSector(array $data)
    {
        $data['user_created_id'] = Auth::id() ?? 1;
        $data['user_updated_id'] = Auth::id() ?? 1;
        return $this->culturalSectorRepository->create($data);
    }

    public function updateSector($uuid, array $data)
    {
        $data['user_updated_id'] = Auth::id() ?? 1;
        return $this->culturalSectorRepository->update($uuid, $data);
    }

    public function deleteSector($uuid)
    {
        return $this->culturalSectorRepository->delete($uuid);
    }
}
