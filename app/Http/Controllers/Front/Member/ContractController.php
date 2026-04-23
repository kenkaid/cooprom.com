<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Services\Front\Member\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    protected $service;

    public function __construct(ContractService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $contracts = $this->service->getAllForCurrentUser();
        return view('front.member.contracts.index', compact('contracts'));
    }

    public function show(Contract $contract)
    {
        if (!$this->service->canAccess($contract)) {
            abort(403);
        }
        return view('front.member.contracts.show', compact('contract'));
    }

    public function sign(Request $request, Contract $contract)
    {
        if (!$this->service->canAccess($contract)) {
            abort(403);
        }

        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Le mot de passe est obligatoire pour signer le contrat.',
        ]);

        $result = $this->service->sign($contract, $request->password);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    public function uploadSigned(Request $request, Contract $contract)
    {
        if (!$this->service->canAccess($contract)) {
            abort(403);
        }

        $request->validate([
            'signed_file' => 'required|file|mimes:pdf|max:12288',
        ], [
            'signed_file.required' => 'Veuillez sélectionner le fichier du contrat signé.',
            'signed_file.mimes' => 'Le fichier doit être au format PDF.',
            'signed_file.max' => 'Le fichier ne doit pas dépasser 12 Mo.',
        ]);

        $result = $this->service->uploadSignedContract($contract, $request->file('signed_file'));

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
