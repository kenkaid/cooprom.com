<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // TEST NOTIFICATION (à retirer après test)
        /*
        if ($user->unreadNotifications->count() == 0) {
            $user->notify(new \App\Notifications\MemberGenericNotification([
                'title' => 'Bienvenue sur votre espace',
                'message' => 'Ceci est une notification de test pour vérifier le système.',
                'icon' => 'fa-star',
                'url' => route('member.profile.edit'),
                'buttonText' => 'Compléter mon profil'
            ]));
        }
        */

        $stats = [
            'contracts' => \App\Models\Contract::where('user_id', $user->id)->count(),
            'productions' => \App\Models\Production::where('user_id', $user->id)->count(),
            'visas' => \App\Models\VisaApplication::where('user_id', $user->id)->count(),
        ];
        return view('front.member.dashboard', compact('user', 'stats'));
    }
}
