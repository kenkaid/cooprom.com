<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\CulturalSector;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::with('culturalSectors')->orderBy('order_column')->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = CulturalSector::orderBy('name')->get();
        return view('admin.attributes.form', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,email,date,select,textarea,checkbox',
            'is_required' => 'nullable',
            'allowed_roles' => 'nullable|string',
            'options' => 'nullable|string', // Comma separated for select
            'cultural_sectors' => 'nullable|array',
            'cultural_sectors.*' => 'exists:cultural_sectors,id',
            'order_column' => 'nullable|integer',
            'validation_rules' => 'nullable|string',
        ]);

        $validated['name'] = Str::slug($validated['label'], '_');
        $validated['is_required'] = $request->has('is_required');

        if (isset($validated['options']) && $validated['options']) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $attribute = Attribute::create($validated);

        if ($request->has('cultural_sectors')) {
            $attribute->culturalSectors()->sync($request->cultural_sectors);
        }

        return redirect()->route('admin.attributes.index')->with('success', 'Attribut créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $attribute = Attribute::where('uuid', $uuid)->firstOrFail();
        return view('admin.attributes.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $attribute = Attribute::where('uuid', $uuid)->firstOrFail();
        $sectors = CulturalSector::orderBy('name')->get();
        return view('admin.attributes.form', compact('attribute', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $attribute = Attribute::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,email,date,select,textarea,checkbox',
            'is_required' => 'nullable',
            'allowed_roles' => 'nullable|string',
            'options' => 'nullable|string',
            'cultural_sectors' => 'nullable|array',
            'cultural_sectors.*' => 'exists:cultural_sectors,id',
            'order_column' => 'nullable|integer',
            'validation_rules' => 'nullable|string',
        ]);

        $validated['is_required'] = $request->has('is_required');

        if (isset($validated['options']) && $validated['options']) {
            $validated['options'] = array_map('trim', explode(',', $validated['options']));
        } else {
            $validated['options'] = null;
        }

        $attribute->update($validated);

        if ($request->has('cultural_sectors')) {
            $attribute->culturalSectors()->sync($request->cultural_sectors);
        } else {
            $attribute->culturalSectors()->detach();
        }

        return redirect()->route('admin.attributes.index')->with('success', 'Attribut mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $attribute = Attribute::where('uuid', $uuid)->firstOrFail();
        $attribute->delete();

        return redirect()->route('admin.attributes.index')->with('success', 'Attribut supprimé avec succès.');
    }
}
