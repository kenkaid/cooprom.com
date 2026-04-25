<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Str;

class ContactRepository
{
    public function create(array $data)
    {
        return Contact::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'message' => $data['contact_message'],
        ]);
    }
}
