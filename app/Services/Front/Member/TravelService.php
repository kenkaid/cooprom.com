<?php

namespace App\Services\Front\Member;

use App\Repositories\TravelRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewTravelNotification;
use Illuminate\Support\Facades\Notification;

use App\Models\VisaApplication;

class TravelService
{
    protected $repository;

    public function __construct(TravelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getVisaApplicationsForCurrentUser()
    {
        return $this->repository->getVisaApplicationsForUser(Auth::id());
    }

    public function getAvailableTravels()
    {
        return $this->repository->getPlannedTravels();
    }

    public function submitVisaApplication(array $data)
    {
        $travel = null;
        if (isset($data['travel_id']) && $data['travel_id']) {
            $travel = $this->repository->findTravelByUuid($data['travel_id']);
        }

        $visaApplication = $this->repository->createVisaApplication([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => Auth::id(),
            'travel_id' => $travel ? $travel->id : null,
            'country' => $data['country'],
            'visa_type' => $data['visa_type'],
            'required_documents' => $data['required_documents'] ?? null,
            'status' => 'pending',
        ]);

        // Notify Admins
        $admins = User::role(['super-admin', 'admin'])->get();
        Notification::send($admins, new NewTravelNotification($visaApplication));

        return $visaApplication;
    }
    public function getVisaApplicationByUuid($uuid)
    {
        return $this->repository->findVisaApplicationByUuid($uuid);
    }

    public function canAccess(VisaApplication $visaApplication)
    {
        return $visaApplication->user_id === Auth::id();
    }

    public function updateVisaApplication(VisaApplication $visaApplication, array $data)
    {
        $travel = null;
        if (isset($data['travel_id']) && $data['travel_id']) {
            $travel = $this->repository->findTravelByUuid($data['travel_id']);
        }

        return $this->repository->updateVisaApplication($visaApplication, [
            'travel_id' => $travel ? $travel->id : null,
            'country' => $data['country'],
            'visa_type' => $data['visa_type'],
            'required_documents' => $data['required_documents'] ?? $visaApplication->required_documents,
        ]);
    }

    public function deleteVisaApplication(VisaApplication $visaApplication)
    {
        if ($visaApplication->status !== 'pending') {
            throw new \Exception("Seules les demandes en attente peuvent être supprimées.");
        }

        return $this->repository->deleteVisaApplication($visaApplication);
    }
}
