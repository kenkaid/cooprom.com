<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($uuid)
    {
        $contact = Contact::where('uuid', $uuid)->firstOrFail();
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($uuid)
    {
        $contact = Contact::where('uuid', $uuid)->firstOrFail();
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Message supprimé avec succès.');
    }
}
