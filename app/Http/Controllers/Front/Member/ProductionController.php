<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Http\Requests\Front\Member\ProductionRequest;
use App\Services\Front\Member\ProductionService;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    protected ProductionService $service;

    public function __construct(ProductionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $productions = $this->service->getAllForCurrentUser();
        return view('front.member.productions.index', compact('productions'));
    }

    public function create()
    {
        return view('front.member.productions.create');
    }

    public function store(ProductionRequest $request)
    {
        $this->service->createProduction($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Votre projet de production a été soumis avec succès.',
                'redirect' => route('member.productions.index')
            ]);
        }

        return redirect()->route('member.productions.index')->with('success', 'Votre projet de production a été soumis avec succès.');
    }

    public function edit(Production $production)
    {
        if (!$this->service->canAccess($production)) {
            return redirect()->route('member.productions.index')->with('error', 'Action non autorisée.');
        }

        return view('front.member.productions.edit', compact('production'));
    }

    public function update(ProductionRequest $request, Production $production)
    {
        if (!$this->service->canAccess($production)) {
            return response()->json(['success' => false, 'message' => 'Action non autorisée.'], 403);
        }

        $this->service->updateProduction($production, $request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Votre projet de production a été mis à jour avec succès.',
                'redirect' => route('member.productions.index')
            ]);
        }

        return redirect()->route('member.productions.index')->with('success', 'Votre projet de production a été mis à jour avec succès.');
    }

    public function destroy(Production $production)
    {
        if (!$this->service->canAccess($production)) {
            return redirect()->route('member.productions.index')->with('error', 'Action non autorisée.');
        }

        $this->service->deleteProduction($production);

        return redirect()->route('member.productions.index')->with('success', 'Le projet a été supprimé.');
    }
}
