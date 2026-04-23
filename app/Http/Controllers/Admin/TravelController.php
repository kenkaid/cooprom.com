<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::latest()->get();
        return view('admin.travel.index', compact('travels'));
    }

    public function create()
    {
        return view('admin.travel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'type' => 'required|in:group,individual',
            'description' => 'nullable|string',
        ]);

        Travel::create([
            'uuid' => (string) Str::uuid(),
            'title' => $request->title,
            'destination' => $request->destination,
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'type' => $request->type,
            'description' => $request->description,
            'status' => 'planned',
        ]);

        return redirect()->route('admin.travels.index')->with('success', 'Le voyage a été créé avec succès.');
    }

    public function edit(Travel $travel)
    {
        return view('admin.travel.edit', compact('travel'));
    }

    public function update(Request $request, Travel $travel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'type' => 'required|in:group,individual',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        $travel->update($request->all());

        return redirect()->route('admin.travels.index')->with('success', 'Le voyage a été mis à jour.');
    }

    public function destroy(Travel $travel)
    {
        $travel->delete();
        return redirect()->route('admin.travels.index')->with('success', 'Le voyage a été supprimé.');
    }
}
