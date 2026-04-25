@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Communication</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Messages Contacts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Détails du message</h5>
            <div class="ms-auto">
                <form action="{{ route('admin.contacts.destroy', $contact->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer ce message</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="form-label font-weight-bold">Nom & Prénom :</label>
                <div class="form-control-plaintext border p-2 bg-light">{{ $contact->name }} {{ $contact->last_name }}</div>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label font-weight-bold">Date de réception :</label>
                <div class="form-control-plaintext border p-2 bg-light">{{ $contact->created_at->format('d/m/Y H:i:s') }}</div>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label font-weight-bold">Email :</label>
                <div class="form-control-plaintext border p-2 bg-light"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label font-weight-bold">Téléphone :</label>
                <div class="form-control-plaintext border p-2 bg-light">{{ $contact->phone ?? 'N/A' }}</div>
            </div>
            <div class="col-12">
                <label class="form-label font-weight-bold">Message :</label>
                <div class="form-control border p-3 bg-light" style="min-height: 200px; white-space: pre-wrap;">{{ $contact->message }}</div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <a href="mailto:{{ $contact->email }}" class="btn btn-primary">Répondre par email</a>
        </div>
    </div>
</div>
@endsection
