<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthInsuranceDetail;
use App\Services\Admin\HealthInsuranceService;
use Illuminate\Http\Request;

class HealthInsuranceController extends Controller
{
    protected $service;

    public function __construct(HealthInsuranceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insurances = $this->service->getAll();
        return view('admin.health_insurance.index', compact('insurances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.health_insurance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'insurance_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coverage_details' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'external_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.health-insurances.index')
            ->with('success', 'Information d\'assurance ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthInsuranceDetail $healthInsurance)
    {
        return view('admin.health_insurance.show', compact('healthInsurance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthInsuranceDetail $healthInsurance)
    {
        return view('admin.health_insurance.edit', compact('healthInsurance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthInsuranceDetail $healthInsurance)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'insurance_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coverage_details' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'external_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $this->service->update($healthInsurance, $validated);

        return redirect()->route('admin.health-insurances.index')
            ->with('success', 'Information d\'assurance mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthInsuranceDetail $healthInsurance)
    {
        $this->service->delete($healthInsurance);

        return redirect()->route('admin.health-insurances.index')
            ->with('success', 'Information d\'assurance supprimée.');
    }
}
