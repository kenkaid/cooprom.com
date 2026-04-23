<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Notifications\MemberGenericNotification;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $productions = Production::with('user')->latest()->get();
        return view('admin.production.index', compact('productions'));
    }

    public function show(Production $production)
    {
        return view('admin.production.show', compact('production'));
    }

    public function monitoring()
    {
        $productions = Production::with('user')
            ->whereIn('status', ['pending', 'in_progress'])
            ->latest()
            ->get();
        return view('admin.production.monitoring', compact('productions'));
    }

    public function updateStatus(Request $request, Production $production)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,rejected',
            'admin_note' => 'nullable|string'
        ]);

        $production->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note
        ]);

        // Notification au membre
        $statusLabels = [
            'pending' => 'En attente',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'rejected' => 'Rejeté'
        ];

        $production->user->notify(new MemberGenericNotification([
            'title' => 'Mise à jour de votre projet de production',
            'message' => "Le statut de votre projet \"" . $production->title . "\" est passé à : " . ($statusLabels[$request->status] ?? $request->status),
            'icon' => $request->status == 'completed' ? 'fa-check-double' : ($request->status == 'rejected' ? 'fa-times-circle' : 'fa-spinner'),
            'url' => route('member.productions.index'),
            'buttonText' => 'Voir mes projets'
        ]));

        return back()->with('success', 'Le statut du projet a été mis à jour.');
    }
}
