@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.visa_applications.index') }}">Demandes de Visa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h5 class="mb-4">Détails de la demande de visa</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase">Artiste</label>
                        <p class="fw-bold">{{ $visaApplication->user->name }} {{ $visaApplication->user->last_name ?? '' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase">Pays de destination</label>
                        <p class="fw-bold">{{ $visaApplication->country }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase">Type de visa</label>
                        <p class="fw-bold">{{ $visaApplication->visa_type }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase">Date de demande</label>
                        <p class="fw-bold">{{ $visaApplication->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if($visaApplication->travel)
                    <div class="col-12">
                        <label class="form-label text-muted small text-uppercase">Voyage de groupe lié</label>
                        <p class="fw-bold text-primary">{{ $visaApplication->travel->title }} ({{ $visaApplication->travel->destination }})</p>
                    </div>
                    @endif
                    <div class="col-12">
                        <label class="form-label text-muted small text-uppercase">Documents fournis / Informations</label>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($visaApplication->required_documents)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h5 class="mb-4">Action administrative</h5>
                @php
                    $isStatusFinal = in_array($visaApplication->status, ['approved', 'rejected']);
                    $canModify = ! $isStatusFinal || auth()->user()->hasRole('super-admin');
                @endphp

                @if($canModify)
                <form action="{{ route('admin.visa_applications.update_status', $visaApplication->uuid) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut de la demande</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $visaApplication->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="submitted" {{ $visaApplication->status == 'submitted' ? 'selected' : '' }}>Déposée à l'ambassade</option>
                            <option value="approved" {{ $visaApplication->status == 'approved' ? 'selected' : '' }}>Accordée</option>
                            <option value="rejected" {{ $visaApplication->status == 'rejected' ? 'selected' : '' }}>Refusée</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admin_note" class="form-label">Note / Feedback pour l'artiste</label>
                        <textarea name="admin_note" id="admin_note" class="form-control" rows="5" placeholder="Ex: Manque photo d'identité, rendez-vous le 12/05...">{{ $visaApplication->admin_note }}</textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Mettre à jour la demande</button>
                    </div>
                </form>
                @else
                    <div class="alert alert-info">
                        Cette demande est déjà <strong>{{ $visaApplication->status == 'approved' ? 'Accordée' : 'Refusée' }}</strong>.
                        Seul un super-administrateur peut modifier ce statut.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut actuel</label>
                        <input type="text" class="form-control" value="{{ $visaApplication->status == 'approved' ? 'Accordée' : 'Refusée' }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note / Feedback</label>
                        <div class="p-3 bg-light rounded border">
                            {!! nl2br(e($visaApplication->admin_note)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <h6 class="mb-3">Coordonnées de l'artiste</h6>
                <p class="mb-1 small"><i class="bi bi-envelope me-2"></i>{{ $visaApplication->user->email }}</p>
                <p class="mb-0 small"><i class="bi bi-telephone me-2"></i>{{ $visaApplication->user->phone ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
