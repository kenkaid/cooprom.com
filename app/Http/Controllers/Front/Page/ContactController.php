<?php

namespace App\Http\Controllers\Front\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return view('front.pages.contact.create');
    }

    public function store(ContactRequest $request)
    {
        $this->contactService->storeContact($request->validated());

        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
