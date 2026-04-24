<?php

namespace App\Services\Front\Member;

use App\Repositories\ProductionRepository;
use App\Models\Production;
use App\Models\User;
use App\Notifications\NewProductionNotification;
use App\Notifications\MemberGenericNotification;
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
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if (isset($data['attachment_file'])) {
            $data['attachment'] = $data['attachment_file']->store('productions/attachments', 'public');
        }

        $production = $this->repository->create($data);

        // Notify Admins
        $admins = User::role(['super-admin', 'admin'])->get();
        Notification::send($admins, new NewProductionNotification($production));

        // Notify User (Success Feedback)
        Auth::user()->notify(new MemberGenericNotification([
            'title' => 'Projet Soumis',
            'message' => 'Votre projet de production "' . $production->title . '" a été envoyé avec succès.',
            'icon' => 'fa-check-circle',
            'url' => route('member.productions.index'),
            'buttonText' => 'Voir mes productions'
        ]));

        return $production;
    }

    public function updateProduction(Production $production, array $data): Production
    {
        //\Log::info('ProductionService Updating:', $data);
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
