<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Models\LegalConsultation;
use App\Models\User;
use App\Notifications\AdminGenericNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LegalConsultationController extends Controller
{
    public function index()
    {
        $consultations = LegalConsultation::where('user_id', Auth::id())->latest()->get();
        return view('front.member.legal.index', compact('consultations'));
    }

    public function create()
    {
        return view('front.member.legal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|in:copyright,contract,social,tax,other',
            'message' => 'required|string',
        ]);

        $consultation = LegalConsultation::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'category' => $request->category,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        // Notifier les administrateurs
        $admins = User::role(['super-admin', 'admin'])->get();
        Notification::send($admins, new AdminGenericNotification([
            'title' => 'Nouvelle question juridique',
            'message' => 'L\'artiste ' . Auth::user()->name . ' ' . Auth::user()->last_name . ' a posé une nouvelle question : ' . $request->subject,
            'icon' => 'bi-shield-lock',
            'url' => route('admin.legal-consultations.show', $consultation->uuid),
            'buttonText' => 'Voir la question'
        ]));

        return redirect()->route('member.legal.index')->with('success', 'Votre demande de conseil juridique a été envoyée.');
    }

    public function show($uuid)
    {
        $consultation = LegalConsultation::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();
        return view('front.member.legal.show', compact('consultation'));
    }
}
