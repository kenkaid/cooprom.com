<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Member\ProfileRequest;
use App\Services\Front\Member\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function edit()
    {
        $user = auth()->user();
        $sectors = $this->service->getSectors();
        return view('front.member.profile.edit', compact('user', 'sectors'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $this->service->updateProfile($user, $request->all());

        return back()->with('success', 'Votre profil a été mis à jour avec succès.');
    }
}
