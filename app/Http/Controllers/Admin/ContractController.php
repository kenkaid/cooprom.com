<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractTemplate;
use App\Models\User;
use App\Notifications\MemberGenericNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['user', 'contractable'])->latest()->get();
        return view('admin.contract.index', compact('contracts'));
    }

    public function create()
    {
        // On ne filtre que les adhérents qui ont des productions ou des demandes de visa
        // qui n'ont pas encore de contrat 'signed'.
        $users = User::role('adhérent')
            ->where(function($query) {
                $query->whereHas('productions', function($q) {
                    $q->whereDoesntHave('contracts', function($sq) {
                        $sq->where('status', 'signed');
                    });
                })
                ->orWhereHas('visaApplications', function($q) {
                    $q->whereDoesntHave('contracts', function($sq) {
                        $sq->where('status', 'signed');
                    });
                });
            })
            ->get();

        $productions = \App\Models\Production::all();
        $visaApplications = \App\Models\VisaApplication::all();
        $types = [
            'travel' => 'Contrat de voyage',
            'production' => 'Contrat de Production',
            'exposition' => 'Contrat d\'Exposition',
            'distribution' => 'Contrat de Distribution',
            'prestations' => 'Contrat de Prestations',
            'partenariat' => 'Contrat de Partenariat',
            'autre' => 'Autre type de contrat'
        ];
        return view('admin.contract.create', compact('users', 'types', 'productions', 'visaApplications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contractable_type' => 'nullable|string',
            'contractable_id' => 'nullable|integer',
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,signed,expired,cancelled,closed',
            'file' => 'nullable|file|mimes:pdf|max:12288', // 12MB max
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('contracts', 'public');
            $validated['file_path'] = $path;
        }

        $contract = Contract::create($validated);

        // Notification à l'adhérent
        $contract->user->notify(new MemberGenericNotification([
            'title' => 'Nouveau contrat disponible',
            'message' => 'Un nouveau contrat intitulé "' . $contract->title . '" a été créé pour vous. Merci d\'en prendre connaissance et de procéder à sa signature.',
            'icon' => 'fa-file-contract',
            'url' => route('member.contracts.show', $contract),
            'buttonText' => 'Voir le contrat'
        ]));

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Le contrat a été créé avec succès.');
    }

    public function show(Contract $contract)
    {
        return view('admin.contract.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        // Pour l'édition, on inclut l'adhérent actuel du contrat même s'il ne remplit plus les conditions
        $users = User::role('adhérent')
            ->where(function($query) use ($contract) {
                $query->whereHas('productions', function($q) {
                    $q->whereDoesntHave('contracts', function($sq) {
                        $sq->where('status', 'signed');
                    });
                })
                ->orWhereHas('visaApplications', function($q) {
                    $q->whereDoesntHave('contracts', function($sq) {
                        $sq->where('status', 'signed');
                    });
                })
                ->orWhere('id', $contract->user_id);
            })
            ->get();

        $productions = \App\Models\Production::all();
        $visaApplications = \App\Models\VisaApplication::all();
        $types = [
            'travel' => 'Contrat de voyage',
            'production' => 'Contrat de Production',
            'exposition' => 'Contrat d\'Exposition',
            'distribution' => 'Contrat de Distribution',
            'prestations' => 'Contrat de Prestations',
            'partenariat' => 'Contrat de Partenariat',
            'autre' => 'Autre type de contrat'
        ];
        return view('admin.contract.edit', compact('contract', 'users', 'types', 'productions', 'visaApplications'));
    }

    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contractable_type' => 'nullable|string',
            'contractable_id' => 'nullable|integer',
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,signed,expired,cancelled,closed',
            'admin_note' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:12288',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($contract->file_path) {
                Storage::disk('public')->delete($contract->file_path);
            }
            $path = $request->file('file')->store('contracts', 'public');
            $validated['file_path'] = $path;
        }

        $contract->update($validated);

        if ($contract->status === 'draft' && $request->status === 'draft') {
             // C'est un rejet
             $contract->user->notify(new \App\Notifications\MemberGenericNotification([
                'title' => 'Contrat rejeté',
                'message' => 'Votre signature pour le contrat "' . $contract->title . '" a été rejetée. Note : ' . $contract->admin_note,
                'icon' => 'fa-exclamation-triangle',
                'url' => route('member.contracts.show', $contract),
                'buttonText' => 'Voir les détails'
            ]));

             return redirect()->route('admin.contracts.index')
                ->with('warning', 'La signature du contrat a été rejetée. L\'adhérent a été notifié.');
        }

        if ($contract->status === 'closed') {
            // Notification au membre
            $contract->user->notify(new \App\Notifications\MemberGenericNotification([
                'title' => 'Contrat validé',
                'message' => 'Votre contrat "' . $contract->title . '" a été validé par l\'administration. Une invitation à un rendez-vous vous sera envoyée prochainement.',
                'icon' => 'fa-file-check',
                'url' => route('member.contracts.show', $contract),
                'buttonText' => 'Voir mon contrat'
            ]));

            return redirect()->route('admin.appointments.index', [
                'user_id' => $contract->user_id,
                'contract_id' => $contract->id,
                'type' => \App\Models\Contract::class,
                'action' => 'schedule'
            ])->with('success', 'Le contrat a été clôturé. Vous pouvez maintenant fixer un rendez-vous pour cet adhérent.');
        }

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Le contrat a été mis à jour avec succès.');
    }

    public function destroy(Contract $contract)
    {
        if ($contract->file_path) {
            Storage::disk('public')->delete($contract->file_path);
        }
        $contract->delete();

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Le contrat a été supprimé avec succès.');
    }

    public function templates()
    {
        $templates = ContractTemplate::latest()->get();
        $types = [
            'travel' => 'Contrat de voyage',
            'production' => 'Contrat de Production',
            'exposition' => 'Contrat d\'Exposition',
            'distribution' => 'Contrat de Distribution',
            'prestations' => 'Contrat de Prestations',
            'partenariat' => 'Contrat de Partenariat',
            'autre' => 'Autre type de contrat'
        ];
        return view('admin.contract.templates', compact('templates', 'types'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('contract_templates', 'public');

            ContractTemplate::create([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'description' => $validated['description'],
                'file_path' => $path,
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
            ]);

            return redirect()->back()->with('success', 'Modèle de contrat ajouté avec succès.');
        }

        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'upload.');
    }

    public function destroyTemplate(ContractTemplate $template)
    {
        if ($template->file_path) {
            Storage::disk('public')->delete($template->file_path);
        }
        $template->delete();

        return redirect()->back()->with('success', 'Modèle de contrat supprimé avec succès.');
    }

    public function downloadTemplate(ContractTemplate $template)
    {
        if (!Storage::disk('public')->exists($template->file_path)) {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
        }

        return Storage::disk('public')->download($template->file_path, $template->name . '.' . $template->extension);
    }

    public function getRelatedItems($userId)
    {
        // On récupère les productions et visas qui n'ont pas de contrat signé
        $productions = \App\Models\Production::with(['contracts' => function($q) {
                $q->latest();
            }])
            ->where('user_id', $userId)
            ->whereDoesntHave('contracts', function($q) {
                $q->where('status', 'signed');
            })
            ->get();

        $visaApplications = \App\Models\VisaApplication::with(['travel', 'contracts' => function($q) {
                $q->latest();
            }])
            ->where('user_id', $userId)
            ->whereDoesntHave('contracts', function($q) {
                $q->where('status', 'signed');
            })
            ->get();

        $formattedProductions = $productions->map(function($prod) {
            $lastContract = $prod->contracts->first();
            $statusLabel = $lastContract ? " [Contrat: " . ucfirst($lastContract->status) . "]" : " [Aucun contrat]";
            return [
                'id' => $prod->id,
                'title' => $prod->title . $statusLabel,
                'uuid' => $prod->uuid,
                'contract_status' => $lastContract ? $lastContract->status : null
            ];
        });

        $formattedVisas = $visaApplications->map(function($visa) {
            $lastContract = $visa->contracts->first();
            $statusLabel = $lastContract ? " [Contrat: " . ucfirst($lastContract->status) . "]" : " [Aucun contrat]";
            $title = ($visa->travel ? $visa->travel->destination : $visa->country) . " (" . $visa->visa_type . ")";
            return [
                'id' => $visa->id,
                'title' => $title . $statusLabel,
                'uuid' => $visa->uuid,
                'contract_status' => $lastContract ? $lastContract->status : null
            ];
        });

        return response()->json([
            'productions' => $formattedProductions,
            'visas' => $formattedVisas
        ]);
    }
}
