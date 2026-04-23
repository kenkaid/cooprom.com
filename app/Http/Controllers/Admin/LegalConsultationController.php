<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalConsultation;
use App\Notifications\MemberGenericNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = LegalConsultation::with('user')->latest()->get();
        return view('admin.legal_consultation.index', compact('consultations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalConsultation $legalConsultation)
    {
        return view('admin.legal_consultation.show', compact('legalConsultation'));
    }

    /**
     * Update the specified resource in storage. (Answer/Update status)
     */
    public function update(Request $request, LegalConsultation $legalConsultation)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,answered,closed',
            'admin_response' => 'nullable|string',
        ]);

        $data = [
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ];

        if ($request->admin_response && $legalConsultation->status !== 'answered' && $request->status === 'answered') {
            $data['answered_at'] = now();
            $data['answered_by'] = Auth::id();
        }

        $legalConsultation->update($data);

        // Notifier le membre si une réponse a été apportée
        if ($request->admin_response && $request->status === 'answered') {
            $legalConsultation->user->notify(new MemberGenericNotification([
                'title' => 'Réponse à votre question juridique',
                'message' => 'Un administrateur a répondu à votre question : ' . $legalConsultation->subject,
                'icon' => 'bi-shield-lock-fill',
                'url' => route('member.legal.show', $legalConsultation->uuid),
                'buttonText' => 'Voir la réponse'
            ]));
        }

        return redirect()->back()->with('success', 'La consultation a été mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalConsultation $legalConsultation)
    {
        $legalConsultation->delete();
        return redirect()->route('admin.legal-consultations.index')->with('success', 'La consultation a été supprimée.');
    }
}
