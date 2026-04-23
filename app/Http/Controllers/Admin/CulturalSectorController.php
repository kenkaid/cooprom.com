<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CulturalSectorRequest;
use App\Services\CulturalSectorService;
use Illuminate\Http\Request;

class CulturalSectorController extends Controller
{
    protected CulturalSectorService $culturalSectorService;

    public function __construct(CulturalSectorService $culturalSectorService)
    {
        $this->culturalSectorService = $culturalSectorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = $this->culturalSectorService->getAllSectors();
        return view('admin.cultural_sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cultural_sector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CulturalSectorRequest $request)
    {
        $this->culturalSectorService->createSector($request->validated());
        return redirect()->route('admin.cultural-sectors.create')->with('success', 'Secteur culturel créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $sector = $this->culturalSectorService->getSector($uuid);
        return view('admin.cultural_sector.update', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $sector = $this->culturalSectorService->getSector($uuid);
        return view('admin.cultural_sector.update', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CulturalSectorRequest $request, string $uuid)
    {
        $this->culturalSectorService->updateSector($uuid, $request->validated());
        return redirect()->route('admin.cultural-sectors.index')->with('success', 'Secteur culturel mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $this->culturalSectorService->deleteSector($uuid);
        return redirect()->route('admin.cultural-sectors.index')->with('success', 'Secteur culturel supprimé avec succès.');
    }
}
