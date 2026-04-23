<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication;
use App\Notifications\MemberGenericNotification;
use Illuminate\Http\Request;

class VisaApplicationController extends Controller
{
    public function index()
    {
        $visas = VisaApplication::with(['user', 'travel'])->latest()->get();
        return view('admin.visa_application.index', compact('visas'));
    }

    public function show(VisaApplication $visaApplication)
    {
        return view('admin.visa_application.show', compact('visaApplication'));
    }

    public function updateStatus(Request $request, VisaApplication $visaApplication)
    {
        // Vérifier si le statut actuel est final et si l'utilisateur n'est pas super-admin
        $isStatusFinal = in_array($visaApplication->status, ['approved', 'rejected']);
        if ($isStatusFinal && ! auth()->user()->hasRole('super-admin')) {
            return back()->with('error', 'Vous n\'avez pas l\'autorisation de modifier une demande déjà traitée.');
        }

        $request->validate([
            'status' => 'required|in:pending,submitted,approved,rejected',
            'admin_note' => 'nullable|string'
        ]);

        $visaApplication->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note
        ]);

        // Notification au membre
        $statusLabels = [
            'pending' => 'En attente',
            'submitted' => 'Soumis',
            'approved' => 'Approuvé',
            'rejected' => 'Rejeté'
        ];

        $visaApplication->user->notify(new MemberGenericNotification([
            'title' => 'Mise à jour de votre demande de visa',
            'message' => "Le statut de votre demande de visa pour " . $visaApplication->country . " est passé à : " . ($statusLabels[$request->status] ?? $request->status),
            'icon' => $request->status == 'approved' ? 'fa-check-circle' : ($request->status == 'rejected' ? 'fa-times-circle' : 'fa-info-circle'),
            'url' => route('member.travels.index'), // Ou une vue spécifique si elle existe
            'buttonText' => 'Voir mes demandes'
        ]));

        return back()->with('success', 'Le statut de la demande de visa a été mis à jour.');
    }
}
