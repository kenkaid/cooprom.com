@extends('admin.layouts.app')

@section('title', 'Détails du Contrat - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Opérations Métiers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contracts.index') }}">Contrats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails du Contrat</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.contracts.edit', $contract) }}" class="btn btn-warning px-4">
                    <i class="bi bi-pencil-fill me-2"></i>Modifier
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $contract->title }}</h4>
                            <p class="text-muted mb-0">Référence UUID : {{ $contract->uuid }}</p>
                        </div>
                        <div>
                            @php
                                $statusClasses = [
                                    'draft' => 'bg-light-warning text-warning',
                                    'signed' => 'bg-light-success text-success',
                                    'expired' => 'bg-light-danger text-danger',
                                    'cancelled' => 'bg-light-dark text-dark',
                                    'closed' => 'bg-light-info text-info',
                                ];
                                $statusLabels = [
                                    'draft' => 'Brouillon',
                                    'signed' => 'Signé',
                                    'expired' => 'Expiré',
                                    'cancelled' => 'Annulé',
                                    'closed' => 'Clôturé',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$contract->status] ?? 'bg-secondary' }} radius-30 px-3">
                                {{ $statusLabels[$contract->status] ?? $contract->status }}
                            </span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-4">
                            <div class="p-3 border radius-10">
                                <small class="text-muted d-block">Type de contrat</small>
                                @php
                                    $typeLabels = [
                                        'travel' => 'Contrat de voyage',
                                        'production' => 'Contrat de Production',
                                        'exposition' => 'Contrat d\'Exposition',
                                        'distribution' => 'Contrat de Distribution',
                                        'prestations' => 'Contrat de Prestations',
                                        'partenariat' => 'Contrat de Partenariat',
                                        'autre' => 'Autre type de contrat'
                                    ];
                                @endphp
                                <span class="fw-bold">{{ $typeLabels[$contract->type] ?? ucfirst($contract->type) }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="p-3 border radius-10">
                                <small class="text-muted d-block">Date de début</small>
                                <span class="fw-bold">{{ $contract->start_date ? \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') : 'Non définie' }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="p-3 border radius-10">
                                <small class="text-muted d-block">Date de fin</small>
                                <span class="fw-bold">{{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') : 'Non définie' }}</span>
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-3">Description / Notes</h6>
                    <div class="p-3 bg-light radius-10 mb-4">
                        {!! nl2br(e($contract->description ?? 'Aucune description fournie.')) !!}
                    </div>

                    @if($contract->file_path)
                        <h6 class="mb-3">Document du contrat original</h6>
                        <div class="card shadow-none border mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-danger"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                    <div class="ms-3">
                                        <h6 class="mb-0">Fichier PDF envoyé à l'adhérent</h6>
                                        <small class="text-muted">Document à signer</small>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{ asset('storage/' . $contract->file_path) }}" target="_blank" class="btn btn-outline-primary radius-30 px-4">Consulter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($contract->signed_file_path)
                        <h6 class="mb-3 text-success">Contrat Signé Retourné</h6>
                        <div class="card shadow-none border border-success mb-4 bg-light-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-success"><i class="bi bi-file-earmark-check-fill"></i></div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-success">Document signé par l'adhérent</h6>
                                        <small class="text-muted">Déposé le {{ $contract->updated_at->format('d/m/Y à H:i') }}</small>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{ asset('storage/' . $contract->signed_file_path) }}" target="_blank" class="btn btn-success radius-30 px-4">Vérifier la signature</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6>Prévisualisation du contrat signé</h6>
                            <div class="ratio ratio-16x9 border radius-10 overflow-hidden">
                                <iframe src="{{ asset('storage/' . $contract->signed_file_path) }}" allow="autoplay"></iframe>
                            </div>
                        </div>
                    @elseif($contract->file_path)
                        <div class="mt-4">
                            <h6>Prévisualisation du document original</h6>
                            <div class="ratio ratio-16x9 border radius-10 overflow-hidden">
                                <iframe src="{{ asset('storage/' . $contract->file_path) }}" allow="autoplay"></iframe>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i> Aucun document PDF n'a été rattaché à ce contrat.
                        </div>
                    @endif

                    @if($contract->status == 'signed')
                        <div class="mt-5 p-4 border border-warning radius-10 bg-light-warning">
                            <h5 class="text-dark fw-bold mb-3">Action Administrative Requise</h5>
                            <p>L'adhérent a retourné le contrat signé. Veuillez vérifier le document ci-dessus puis valider ou rejeter la signature.</p>

                            <form action="{{ route('admin.contracts.update', $contract) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $contract->user_id }}">
                                <input type="hidden" name="type" value="{{ $contract->type }}">
                                <input type="hidden" name="title" value="{{ $contract->title }}">

                                <div class="mb-3">
                                    <label class="form-label">Note administrative (optionnel)</label>
                                    <textarea name="admin_note" class="form-control" rows="3" placeholder="Ex: Signature conforme, ou motif du rejet..."></textarea>
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="submit" name="status" value="closed" class="btn btn-success px-5 radius-30">
                                        <i class="bi bi-check-circle me-2"></i>Valider et Clôturer l'étape
                                    </button>
                                    <button type="submit" name="status" value="draft" class="btn btn-danger px-5 radius-30">
                                        <i class="bi bi-x-circle me-2"></i>Rejeter la signature
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Adhérent concerné</h5>
                    @if($contract->user)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $contract->user->photo) }}" class="rounded-circle shadow" width="100" height="100" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                            <h6 class="mt-3 mb-0">{{ $contract->user->name }} {{ $contract->user->last_name }}</h6>
                            <p class="text-muted small">{{ $contract->user->culturalSector->name ?? 'Artiste' }}</p>
                        </div>
                        <hr>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>
                                <span>{{ $contract->user->email }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone-fill me-2 text-primary"></i>
                                <span>{{ $contract->user->phone_number }}</span>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.users.edit', $contract->user) }}" class="btn btn-outline-primary btn-sm w-100 radius-30">Voir le profil complet</a>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-danger">Utilisateur introuvable</p>
                    @endif
                </div>
            </div>

            @if($contract->contractable)
                <div class="card shadow-sm border-0 mt-3">
                    <div class="card-body">
                        <h5 class="mb-3">Liaison Projet</h5>

                        @if($contract->contractable_type == 'App\Models\Production')
                            <div class="mb-2">
                                <small class="text-muted d-block mb-1">Production associée</small>
                                <div class="d-flex align-items-center p-2 border radius-10">
                                    <div class="widgets-icons-2 rounded bg-light-primary text-primary me-2"><i class="fas fa-project-diagram"></i></div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="mb-0 text-truncate">{{ $contract->contractable->title }}</h6>
                                        <small class="text-muted">{{ ucfirst($contract->contractable->type) }}</small>
                                    </div>
                                    <a href="{{ route('admin.productions.show', $contract->contractable) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        @elseif($contract->contractable_type == 'App\Models\VisaApplication')
                            <div class="mb-2">
                                <small class="text-muted d-block mb-1">Demande de Visa associée</small>
                                <div class="d-flex align-items-center p-2 border radius-10">
                                    <div class="widgets-icons-2 rounded bg-light-success text-success me-2"><i class="fas fa-passport"></i></div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="mb-0 text-truncate">{{ $contract->contractable->country }}</h6>
                                        <small class="text-muted">{{ $contract->contractable->visa_type }}</small>
                                    </div>
                                    <a href="{{ route('admin.visa_applications.show', $contract->contractable) }}" class="btn btn-sm btn-outline-success ms-2"><i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Informations de suivi</h6>
                    <div class="small">
                        <p class="mb-1 text-muted">Créé le :</p>
                        <p class="fw-bold">{{ $contract->created_at->format('d/m/Y à H:i') }}</p>

                        <p class="mb-1 text-muted">Dernière modification :</p>
                        <p class="fw-bold">{{ $contract->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
