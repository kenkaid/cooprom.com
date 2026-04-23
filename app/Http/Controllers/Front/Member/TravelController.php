<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Member\VisaRequest;
use App\Services\Front\Member\TravelService;
use App\Models\VisaApplication;
use App\Models\VisaGuide;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    protected $service;

    public function __construct(TravelService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $visaApplications = $this->service->getVisaApplicationsForCurrentUser();
        return view('front.member.travels.index', compact('visaApplications'));
    }

    public function visaGuides()
    {
        $guides = VisaGuide::where('is_active', true)->latest()->get();
        return view('front.member.travels.guides_index', compact('guides'));
    }

    public function showVisaGuide($uuid)
    {
        $guide = VisaGuide::where('uuid', $uuid)->where('is_active', true)->firstOrFail();
        return view('front.member.travels.guide_show', compact('guide'));
    }

    public function createVisa()
    {
        $availableTravels = $this->service->getAvailableTravels();
        return view('front.member.travels.create_visa', compact('availableTravels'));
    }

    public function storeVisa(VisaRequest $request)
    {
        $this->service->submitVisaApplication($request->all());

        return redirect()->route('member.travels.index')->with('success', 'Votre demande d\'assistance visa a été soumise.');
    }

    public function editVisa($uuid)
    {
        $visaApplication = $this->service->getVisaApplicationByUuid($uuid);

        if (!$visaApplication || !$this->service->canAccess($visaApplication)) {
            return redirect()->route('member.travels.index')->with('error', 'Action non autorisée.');
        }

        $availableTravels = $this->service->getAvailableTravels();
        return view('front.member.travels.edit', compact('visaApplication', 'availableTravels'));
    }

    public function updateVisa(VisaRequest $request, $uuid)
    {
        $visaApplication = $this->service->getVisaApplicationByUuid($uuid);

        if (!$visaApplication || !$this->service->canAccess($visaApplication)) {
            return redirect()->route('member.travels.index')->with('error', 'Action non autorisée.');
        }

        $this->service->updateVisaApplication($visaApplication, $request->all());

        return redirect()->route('member.travels.index')->with('success', 'Votre demande d\'assistance visa a été mise à jour.');
    }

    public function destroyVisa($uuid)
    {
        $visaApplication = $this->service->getVisaApplicationByUuid($uuid);

        if (!$visaApplication || !$this->service->canAccess($visaApplication)) {
            return redirect()->route('member.travels.index')->with('error', 'Action non autorisée.');
        }

        try {
            $this->service->deleteVisaApplication($visaApplication);
            return redirect()->route('member.travels.index')->with('success', 'Votre demande a été supprimée.');
        } catch (\Exception $e) {
            return redirect()->route('member.travels.index')->with('error', $e->getMessage());
        }
    }
}
