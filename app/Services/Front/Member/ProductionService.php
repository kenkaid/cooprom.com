<?php

namespace App\Services\Front\Member;

use App\Repositories\ProductionRepository;
use App\Models\Production;
use App\Models\User;
use App\Notifications\NewProductionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ProductionService
{
    protected $repository;

    public function __construct(ProductionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllForCurrentUser()
    {
        return $this->repository->getForUser(Auth::id());
    }

    public function createProduction(array $data)
    {
        \Log::info('ProductionService Creating:', $data);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if (isset($data['attachment_file'])) {
            $data['attachment'] = $data['attachment_file']->store('productions/attachments', 'public');
        }

        $production = $this->repository->create($data);

        // Notify Admins
        $admins = User::role(['super-admin', 'admin'])->get();
        Notification::send($admins, new NewProductionNotification($production));

        return $production;
    }

    public function updateProduction(Production $production, array $data)
    {
        \Log::info('ProductionService Updating:', $data);
        if (isset($data['attachment_file'])) {
            if ($production->attachment) {
                Storage::disk('public')->delete($production->attachment);
            }
            $data['attachment'] = $data['attachment_file']->store('productions/attachments', 'public');
        }

        return $this->repository->update($production, $data);
    }

    public function deleteProduction(Production $production)
    {
        if ($production->attachment) {
            Storage::disk('public')->delete($production->attachment);
        }
        return $this->repository->delete($production);
    }

    public function canAccess(Production $production)
    {
        return $production->user_id === Auth::id() && ($production->status === 'pending' || $production->status === 'rejected');
    }
}
