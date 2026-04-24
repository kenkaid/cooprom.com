<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{

    public function index()
    {
        //Recherche d'utilisateur qui ont un role staff
        $staffUsers = User::role(['staff'])->get();

        return view('front.pages.home', compact('staffUsers'));
    }

}
