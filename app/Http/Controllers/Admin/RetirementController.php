<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RetirementSimulation;
use App\Services\Admin\RetirementService;
use Illuminate\Http\Request;

class RetirementController extends Controller
{
    protected $service;

    public function __construct(RetirementService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $simulations = $this->service->getAll();
        return view('admin.retirement.index', compact('simulations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.retirement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'current_age' => 'nullable|integer',
            'target_retirement_age' => 'nullable|integer',
            'estimated_monthly_pension' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|in:draft,submitted,processed',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.retirement-simulations.index')
            ->with('success', 'Simulation/Dossier retraite créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RetirementSimulation $retirementSimulation)
    {
        return view('admin.retirement.show', compact('retirementSimulation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RetirementSimulation $retirementSimulation)
    {
        return view('admin.retirement.edit', compact('retirementSimulation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RetirementSimulation $retirementSimulation)
    {
        $validated = $request->validate([
            'estimated_monthly_pension' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|in:draft,submitted,processed',
        ]);

        $this->service->update($retirementSimulation, $validated);

        return redirect()->route('admin.retirement-simulations.index')
            ->with('success', 'Dossier retraite mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RetirementSimulation $retirementSimulation)
    {
        $this->service->delete($retirementSimulation);

        return redirect()->route('admin.retirement-simulations.index')
            ->with('success', 'Dossier retraite supprimé.');
    }
}
