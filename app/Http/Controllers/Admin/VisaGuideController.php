<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaGuide;
use Illuminate\Http\Request;

class VisaGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = VisaGuide::latest()->get();
        return view('admin.visa_guide.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visa_guide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'visa_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'procedure_steps' => 'nullable|string',
            'useful_links' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        VisaGuide::create($validated);

        return redirect()->route('admin.visa-guides.index')
            ->with('success', 'Le guide de visa a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VisaGuide $visaGuide)
    {
        return view('admin.visa_guide.show', compact('visaGuide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisaGuide $visaGuide)
    {
        return view('admin.visa_guide.edit', compact('visaGuide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisaGuide $visaGuide)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'visa_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'procedure_steps' => 'nullable|string',
            'useful_links' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $visaGuide->update($validated);

        return redirect()->route('admin.visa-guides.index')
            ->with('success', 'Le guide de visa a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisaGuide $visaGuide)
    {
        $visaGuide->delete();

        return redirect()->route('admin.visa-guides.index')
            ->with('success', 'Le guide de visa a été supprimé.');
    }
}
