<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/mon-espace/dashboard';

    public function showResetForm(Request $request, $token = null)
    {
        return view('front.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
