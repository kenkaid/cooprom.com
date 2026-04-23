@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.productions.index') }}">Projets de Production</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails du projet</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h5 class="mb-0">{{ $production->title }}</h5>
                    <div class="ms-auto">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-light-warning text-warning',
                                'in_progress' => 'bg-light-info text-info',
                                'completed' => 'bg-light-success text-success',
                                'rejected' => 'bg-light-danger text-danger',
                            ];
                            $statusLabels = [
                                'pending' => 'En attente',
                                'in_progress' => 'En cours',
                                'completed' => 'Terminé',
                                'rejected' => 'Rejeté',
                            ];
                        @endphp
                        <span class="badge {{ $statusClasses[$production->status] ?? 'bg-secondary' }} px-3 py-2 radius-30">
                            {{ $statusLabels[$production->status] ?? $production->status }}
                        </span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Type de production</label>
                        <p class="fw-bold">{{ ucfirst($production->type) }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label text-muted">Budget estimé</label>
                        <p class="fw-bold text-primary">{{ number_format($production->budget, 0, ',', ' ') }} FCFA</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Description du projet</label>
                        <div class="border rounded p-3 bg-light">
                            {!! $production->description !!}
                        </div>
                    </div>
                    @if($production->attachment)
                    <div class="col-12">
                        <label class="form-label text-muted">Pièce jointe / Dossier technique</label>
                        <div class="d-flex align-items-center border rounded p-2">
                            <i class="bi bi-file-earmark-pdf-fill fs-3 text-danger me-2"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Dossier de production</h6>
                                <small class="text-muted">Format: {{ pathinfo($production->attachment, PATHINFO_EXTENSION) }}</small>
                            </div>
                            <a href="{{ asset('storage/' . $production->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary radius-30 px-3">
                                <i class="bi bi-download me-1"></i> Consulter
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="mb-3 text-start">Porteur du projet</h5>
                <img src="{{ asset('storage/' . ($production->user->photo ?? '')) }}" class="rounded-circle shadow" width="120" height="120" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                <h6 class="mb-0 mt-3">{{ $production->user->name ?? 'N/A' }} {{ $production->user->last_name ?? '' }}</h6>
                <p class="text-muted small">{{ $production->user->email ?? '' }}</p>
                <hr>
                <div class="text-start">
                    <p class="mb-1 text-muted small"><i class="bi bi-phone me-2"></i>{{ $production->user->phone_number ?? 'N/A' }}</p>
                    <p class="mb-1 text-muted small"><i class="bi bi-geo-alt me-2"></i>{{ $production->user->address ?? 'N/A' }}</p>
                    <p class="mb-0 text-muted small"><i class="bi bi-briefcase me-2"></i>{{ $production->user->culturalSector->name ?? 'N/A' }}</p>
                </div>
                <a href="{{ route('admin.users.show', $production->user->uuid ?? '') }}" class="btn btn-primary btn-sm radius-30 px-4 mt-3">Voir profil complet</a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="mb-3">Suivi technique (Actions)</h5>
                <form action="{{ route('admin.productions.update-status', $production->uuid) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Mettre à jour le statut</label>
                        <select name="status" class="form-select radius-30">
                            <option value="pending" {{ $production->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="in_progress" {{ $production->status == 'in_progress' ? 'selected' : '' }}>En cours / Validé</option>
                            <option value="completed" {{ $production->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                            <option value="rejected" {{ $production->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note administrative / Feedback</label>
                        <textarea name="admin_note" class="form-control" rows="4" placeholder="Saisir un commentaire pour l'artiste...">{{ $production->admin_note }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 radius-30">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
