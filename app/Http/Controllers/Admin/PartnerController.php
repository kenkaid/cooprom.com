<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Repositories\PartnerRepository;
use App\Services\Admin\PartnerService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * @var PartnerRepository
     */
    protected $partnerRepository;

    /**
     * @var PartnerService
     */
    protected $partnerService;

    /**
     * PartnerController constructor.
     *
     * @param PartnerRepository $partnerRepository
     * @param PartnerService $partnerService
     */
    public function __construct(PartnerRepository $partnerRepository, PartnerService $partnerService)
    {
        $this->partnerRepository = $partnerRepository;
        $this->partnerService = $partnerService;
    }

    /**
     * Display a listing of the partners.
     */
    public function index()
    {
        $partners = $this->partnerRepository->paginate(15);
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new partner.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created partner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->partnerService->storePartner($request->only(['name', 'phone_number', 'description']), $request->file('logo'));

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire créé avec succès.');
    }

    /**
     * Display the specified partner.
     */
    public function show(Partner $partner)
    {
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified partner.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified partner in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->partnerService->updatePartner($partner, $request->only(['name', 'phone_number', 'description']), $request->file('logo'));

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire mis à jour avec succès.');
    }

    /**
     * Remove the specified partner from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->partnerService->deletePartner($partner);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire supprimé avec succès.');
    }
}
