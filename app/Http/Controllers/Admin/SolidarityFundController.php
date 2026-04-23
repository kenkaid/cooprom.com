<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolidarityFundRequest;
use App\Services\Admin\SolidarityFundService;
use Illuminate\Http\Request;

class SolidarityFundController extends Controller
{
    protected $service;

    public function __construct(SolidarityFundService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = $this->service->getAll();
        return view('admin.solidarity_fund.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.solidarity_fund.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'amount_requested' => 'nullable|numeric',
            'reason' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'admin_comment' => 'nullable|string',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.solidarity-fund.index')
            ->with('success', 'Demande créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SolidarityFundRequest $solidarityFund)
    {
        return view('admin.solidarity_fund.show', compact('solidarityFund'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolidarityFundRequest $solidarityFund)
    {
        return view('admin.solidarity_fund.edit', compact('solidarityFund'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolidarityFundRequest $solidarityFund)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_comment' => 'nullable|string',
            'amount_requested' => 'nullable|numeric',
        ]);

        $this->service->update($solidarityFund, $validated);

        return redirect()->route('admin.solidarity-fund.index')
            ->with('success', 'Demande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolidarityFundRequest $solidarityFund)
    {
        $this->service->delete($solidarityFund);

        return redirect()->route('admin.solidarity-fund.index')
            ->with('success', 'Demande supprimée.');
    }
}
