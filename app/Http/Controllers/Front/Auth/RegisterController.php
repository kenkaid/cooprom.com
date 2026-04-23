<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CulturalSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $sectors = CulturalSector::all();
        return view('front.auth.register', compact('sectors'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cultural_sector_id' => 'required|exists:cultural_sectors,id',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cultural_sector_id' => $request->cultural_sector_id,
            'phone_number' => $request->phone_number,
        ]);

        // Assigner le rôle adhérent par défaut
        $user->assignRole('adhérent');

        Auth::login($user);

        return redirect()->route('member.dashboard')->with('success', 'Votre compte a été créé avec succès.');
    }
}
