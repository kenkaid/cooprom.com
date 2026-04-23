<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Models\SolidarityFundRequest;
use App\Models\HealthInsuranceDetail;
use App\Models\RetirementSimulation;
use App\Models\User;
use App\Notifications\AdminGenericNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SocialAssistanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $solidarityRequests = SolidarityFundRequest::where('user_id', $user->id)->latest()->get();
        $retirementSimulations = RetirementSimulation::where('user_id', $user->id)->latest()->get();

        return view('front.member.social.index', compact('solidarityRequests', 'retirementSimulations'));
    }

    public function createSolidarity()
    {
        return view('front.member.social.solidarity_create');
    }

    public function storeSolidarity(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'amount_requested' => 'nullable|numeric|min:0',
            'reason' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $solidarityFundRequest = SolidarityFundRequest::create($validated);

        // Notification Admin
        $admins = User::role('admin')->get();
        Notification::send($admins, new AdminGenericNotification(
            "Nouvelle demande d'aide",
            Auth::user()->name . " sollicite le fonds de solidarité : " . $validated['subject'],
            route('admin.solidarity-fund.index'),
            'bi-heart-fill'
        ));

        return redirect()->route('member.social.index')
            ->with('success', 'Votre demande d\'aide a été soumise avec succès.');
    }

    public function healthInsurances()
    {
        $insurances = HealthInsuranceDetail::where('is_active', true)->get();
        return view('front.member.social.health_insurances', compact('insurances'));
    }

    public function retirementSimulation()
    {
        return view('front.member.social.retirement_create');
    }

    public function storeRetirement(Request $request)
    {
        $validated = $request->validate([
            'current_age' => 'nullable|integer|min:18',
            'target_retirement_age' => 'nullable|integer|min:40',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'submitted';

        $retirementSimulation = RetirementSimulation::create($validated);

        // Notification Admin
        $admins = User::role('admin')->get();
        Notification::send($admins, new AdminGenericNotification(
            "Nouveau dossier retraite",
            Auth::user()->name . " a soumis une demande d'accompagnement retraite.",
            route('admin.retirement-simulations.index'),
            'bi-calculator'
        ));

        return redirect()->route('member.social.index')
            ->with('success', 'Votre demande d\'accompagnement retraite a été transmise.');
    }
}
