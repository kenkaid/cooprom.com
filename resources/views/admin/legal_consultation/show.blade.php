@extends('admin.layouts.app')

@section('title', 'Détails Consultation Juridique - COOPROM Admin')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Conseil Juridique</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.legal-consultations.index') }}">Consultations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $legalConsultation->subject }}</h5>
                        <p class="mb-0 text-muted">Demande soumise le {{ $legalConsultation->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <span class="badge bg-light-info text-info">{{ $legalConsultation->category }}</span>
                </div>

                <div class="p-3 bg-light rounded mb-4">
                    <h6 class="fw-bold mb-2">Message de l'artiste :</h6>
                    <p class="mb-0">{!! nl2br(e($legalConsultation->message)) !!}</p>
                </div>

                <hr>

                <form action="{{ route('admin.legal-consultations.update', $legalConsultation->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="admin_response" class="form-label fw-bold">Votre réponse / Conseil :</label>
                        <textarea name="admin_response" id="admin_response" class="form-control" rows="10" placeholder="Saisissez votre réponse ici...">{{ old('admin_response', $legalConsultation->admin_response) }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Statut :</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $legalConsultation->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="in_progress" {{ $legalConsultation->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="answered" {{ $legalConsultation->status == 'answered' ? 'selected' : '' }}>Répondu</option>
                                <option value="closed" {{ $legalConsultation->status == 'closed' ? 'selected' : '' }}>Clôturé</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Enregistrer la réponse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h6 class="mb-3">Artiste concerné</h6>
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/' . $legalConsultation->user->photo) }}" class="rounded-circle" width="60" height="60" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $legalConsultation->user->name }} {{ $legalConsultation->user->last_name }}</h6>
                        <p class="mb-0 small text-muted">{{ $legalConsultation->user->email }}</p>
                    </div>
                </div>
                <p class="mb-1 small"><i class="bi bi-telephone me-2"></i>{{ $legalConsultation->user->phone_number ?? 'N/A' }}</p>
                <p class="mb-0 small"><i class="bi bi-geo-alt me-2"></i>{{ $legalConsultation->user->address ?? 'N/A' }}</p>
            </div>
        </div>

        @if($legalConsultation->answered_at)
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body p-4">
                    <h6 class="mb-2">Dernière réponse</h6>
                    <p class="small mb-1">Par : {{ $legalConsultation->answerer->name ?? 'Admin' }}</p>
                    <p class="small mb-0">Le : {{ $legalConsultation->answered_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
