@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Suivi Technique (Productions)</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row row-cols-1 row-cols-lg-3 g-4">
    @forelse($productions as $production)
    <div class="col">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/' . ($production->user->photo ?? '')) }}" class="rounded-circle shadow-sm" width="45" height="45" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                    <div class="ms-2">
                        <h6 class="mb-0 font-14">{{ $production->user->name ?? 'N/A' }}</h6>
                        <small class="text-muted">{{ $production->user->culturalSector->name ?? 'Artiste' }}</small>
                    </div>
                    <div class="ms-auto">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-light-warning text-warning',
                                'in_progress' => 'bg-light-info text-info',
                            ];
                            $statusLabels = [
                                'pending' => 'En attente',
                                'in_progress' => 'En cours',
                            ];
                        @endphp
                        <span class="badge {{ $statusClasses[$production->status] ?? 'bg-secondary' }} radius-30">
                            {{ $statusLabels[$production->status] ?? $production->status }}
                        </span>
                    </div>
                </div>
                <h5 class="card-title text-truncate">{{ $production->title }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ Str::limit(strip_tags($production->description), 100) }}
                </p>
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-light-primary text-primary radius-30 px-3">{{ ucfirst($production->type) }}</span>
                    <span class="text-primary fw-bold ms-auto">{{ number_format($production->budget, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="border-top pt-3 mt-3">
                    <div class="d-grid">
                        <a href="{{ route('admin.productions.show', $production->uuid) }}" class="btn btn-outline-primary radius-30">
                            <i class="bi bi-gear-fill me-2"></i>Gérer le projet
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 small text-muted text-center pb-3">
                Soumis le {{ $production->created_at->format('d/m/Y') }}
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 w-100">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h5 class="mt-3">Aucun projet en attente de suivi technique</h5>
                <p class="text-muted">Tous les projets soumis ont été traités ou sont terminés.</p>
                <a href="{{ route('admin.productions.index') }}" class="btn btn-primary radius-30 px-4">Voir tous les projets</a>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
