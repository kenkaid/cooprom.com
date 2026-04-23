<?php

namespace App\Services\Admin;

use App\Repositories\RetirementRepository;
use App\Models\RetirementSimulation;
use App\Notifications\MemberGenericNotification;

class RetirementService
{
    protected $repository;

    public function __construct(RetirementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(RetirementSimulation $simulation, array $data)
    {
        $updatedSimulation = $this->repository->update($simulation, $data);

        // Notification Membre
        if (isset($data['status'])) {
            try {
                $updatedSimulation->user->notify(new MemberGenericNotification([
                    'title' => "Mise à jour de votre dossier retraite",
                    'message' => "Votre dossier retraite est désormais au statut : " . $data['status'],
                    'url' => route('member.social.index'),
                    'icon' => 'fa-calculator'
                ]));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("[RetirementService] Erreur notification: " . $e->getMessage());
            }
        }

        return $updatedSimulation;
    }

    public function delete(RetirementSimulation $simulation)
    {
        return $this->repository->delete($simulation);
    }
}
