<?php

namespace App\Services\Admin;

use App\Repositories\SolidarityFundRepository;
use App\Models\SolidarityFundRequest;
use App\Notifications\MemberGenericNotification;

class SolidarityFundService
{
    protected $repository;

    public function __construct(SolidarityFundRepository $repository)
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

    public function update(SolidarityFundRequest $request, array $data)
    {
        $updatedRequest = $this->repository->update($request, $data);

        // Notification Membre
        if (isset($data['status'])) {
            try {
                $updatedRequest->user->notify(new MemberGenericNotification([
                    'title' => "Mise à jour de votre demande d'aide",
                    'message' => "Votre demande '" . $updatedRequest->subject . "' est passée au statut : " . $data['status'],
                    'url' => route('member.social.index'),
                    'icon' => 'fa-hand-holding-heart'
                ]));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("[SolidarityFundService] Erreur notification: " . $e->getMessage());
            }
        }

        return $updatedRequest;
    }

    public function delete(SolidarityFundRequest $request)
    {
        return $this->repository->delete($request);
    }
}
