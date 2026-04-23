<?php

namespace App\Services\Front\Member;

use App\Repositories\ContractRepository;
use App\Models\Contract;
use App\Models\User;
use App\Notifications\MemberGenericNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ContractService
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllForCurrentUser()
    {
        return $this->repository->getForUser(Auth::id());
    }

    public function canAccess(Contract $contract)
    {
        return $contract->user_id === Auth::id();
    }

    public function sign(Contract $contract, $password)
    {
        $user = Auth::user();

        if (!Hash::check($password, $user->password)) {
            return [
                'success' => false,
                'message' => 'Le mot de passe saisi est incorrect.'
            ];
        }

        if ($contract->status !== 'draft') {
            return [
                'success' => false,
                'message' => 'Ce contrat ne peut plus être signé.'
            ];
        }

        $contract->update([
            'status' => 'signed',
            'signed_file_path' => $contract->file_path, // On considère le fichier original comme signé électroniquement (ou on pourrait avoir un champ spécifique)
            'start_date' => now(), // On utilise la date du jour comme date de signature/début par défaut
        ]);

        $this->updateRelatedItemStatus($contract);
        $this->notifyAdmins($contract, 'signed_electronically');

        return [
            'success' => true,
            'message' => 'Le contrat a été signé avec succès.'
        ];
    }

    public function uploadSignedContract(Contract $contract, $file)
    {
        if ($contract->status !== 'draft') {
            return [
                'success' => false,
                'message' => 'Ce contrat ne peut plus être mis à jour.'
            ];
        }

        $path = $file->store('contracts/signed', 'public');

        $contract->update([
            'status' => 'signed',
            'signed_file_path' => $path,
            'start_date' => now(),
        ]);

        $this->updateRelatedItemStatus($contract);
        $this->notifyAdmins($contract, 'uploaded');

        return [
            'success' => true,
            'message' => 'Le contrat signé a été uploadé avec succès.'
        ];
    }

    protected function updateRelatedItemStatus(Contract $contract)
    {
        // Mise à jour du statut du voyage/visa si lié
        if ($contract->contractable_type === \App\Models\VisaApplication::class && $contract->contractable_id) {
            $visaApplication = $contract->contractable;
            if ($visaApplication && $visaApplication->status === 'pending') {
                $visaApplication->update([
                    'status' => 'submitted'
                ]);
            }
        }

        // Mise à jour du statut de la production si liée
        if ($contract->contractable_type === \App\Models\Production::class && $contract->contractable_id) {
            $production = $contract->contractable;
            if ($production && $production->status === 'pending') {
                $production->update([
                    'status' => 'in_progress'
                ]);
            }
        }
    }

    protected function notifyAdmins(Contract $contract, $method)
    {
        $admins = User::role(['admin', 'super-admin'])->get();

        $methodLabel = $method == 'uploaded' ? 'upload du contrat signé' : 'signature électronique';

        try {
            Notification::send($admins, new MemberGenericNotification([
                'title' => 'Contrat signé par un membre',
                'message' => "Le membre " . Auth::user()->name . " a finalisé son contrat \"" . $contract->title . "\" via " . $methodLabel . ".",
                'icon' => 'fa-file-signature',
                'url' => route('admin.contracts.show', $contract),
                'buttonText' => 'Voir le contrat'
            ]));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("[ContractService] Erreur lors de la notification des administrateurs: " . $e->getMessage());
        }
    }
}
