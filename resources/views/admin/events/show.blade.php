@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Organisation</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Événements</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails de l'événement</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning px-3">
                <i class="bi bi-pencil-fill me-1"></i>Modifier l'événement
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary px-3">
                <i class="bi bi-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $event->title }}">
                @endif

                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-light-primary text-primary me-2">{{ ucfirst($event->type) }}</span>
                    @php
                        $statusClasses = [
                            'draft' => 'bg-light-secondary text-secondary',
                            'published' => 'bg-light-success text-success',
                            'open_registration' => 'bg-light-primary text-primary',
                            'ongoing' => 'bg-light-info text-info',
                            'completed' => 'bg-light-dark text-dark',
                            'cancelled' => 'bg-light-danger text-danger',
                        ];
                        $statusLabels = [
                            'draft' => 'Brouillon',
                            'published' => 'Publié',
                            'open_registration' => 'Ouvert aux inscriptions',
                            'ongoing' => 'En cours',
                            'completed' => 'Terminé',
                            'cancelled' => 'Annulé',
                        ];
                    @endphp
                    <span class="badge {{ $statusClasses[$event->status] ?? 'bg-secondary' }}">
                        {{ $statusLabels[$event->status] ?? $event->status }}
                    </span>
                </div>

                <h3 class="mb-3">{{ $event->title }}</h3>
                <div class="text-muted mb-4">
                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>{{ $event->location ?? 'Lieu non spécifié' }}
                </div>

                <h5 class="mb-3">Description</h5>
                <div class="description-content mb-5">
                    {!! nl2br(e($event->description)) !!}
                </div>

                <hr class="my-4">

                <!-- Liste des Participants -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-users me-2 text-primary"></i>Derniers Inscrits</h5>
                    <div>
                        <a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-list me-1"></i>Voir tout ({{ $event->users()->count() }})
                        </a>
                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel me-1"></i>Exporter</button>
                    </div>
                </div>

                <div class="table-responsive" style="overflow: visible;">
                    <table class="table table-hover align-middle border">
                        <thead class="bg-light">
                            <tr>
                                <th>Participant</th>
                                <th>Contact</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->photo }}" class="rounded-circle me-2" width="35" height="35" alt="">
                                        <div class="font-weight-bold">{{ $user->name }} {{ $user->last_name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <small class="d-block text-muted">{{ $user->email }}</small>
                                </td>
                                <td>
                                    @php
                                        $pivotStatusClasses = [
                                            'pending' => 'bg-light-warning text-warning',
                                            'confirmed' => 'bg-light-success text-success',
                                            'cancelled' => 'bg-light-danger text-danger',
                                        ];
                                        $pivotStatusLabels = [
                                            'pending' => 'En attente',
                                            'confirmed' => 'Confirmé',
                                            'cancelled' => 'Annulé',
                                        ];
                                    @endphp
                                    <span class="badge {{ $pivotStatusClasses[$user->pivot->status] ?? 'bg-secondary' }}">
                                        {{ $pivotStatusLabels[$user->pivot->status] ?? $user->pivot->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-boundary="viewport">
                                            Gérer
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li>
                                                <form action="{{ route('admin.events.update-participant', [$event->id, $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="dropdown-item text-success"><i class="fas fa-check me-2"></i>Confirmer</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.events.update-participant', [$event->id, $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-times me-2"></i>Annuler</button>
                                                </form>
                                            </li>
                                            @if($user->pivot->notes)
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#notesModal{{ $user->id }}">Voir les notes</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Aucun inscrit pour le moment.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($event->users()->count() > 5)
                <div class="text-center mt-3">
                    <a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-link text-primary font-weight-bold">
                        Afficher les {{ $event->users()->count() - 5 }} autres inscrits <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif

                @foreach($participants as $user)
                    @if($user->pivot->notes)
                    <!-- Modal Notes (Toujours nécessaire pour le JS) -->
                    <div class="modal fade" id="notesModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Notes d'inscription : {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">{{ $user->pivot->notes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <!-- Card Budget -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-wallet me-2 text-success"></i>Suivi Budgétaire</h5>
            </div>
            <div class="card-body">
                @if($event->budget_allocated > 0)
                    @php
                        $percentage = ($event->actual_expenses / $event->budget_allocated) * 100;
                        $barClass = $percentage > 100 ? 'bg-danger' : ($percentage > 80 ? 'bg-warning' : 'bg-success');
                    @endphp
                    <div class="d-flex justify-content-between mb-2">
                        <span>Consommation</span>
                        <span class="fw-bold {{ $percentage > 100 ? 'text-danger' : '' }}">{{ number_format($percentage, 1) }}%</span>
                    </div>
                    <div class="progress mb-4" style="height: 10px;">
                        <div class="progress-bar {{ $barClass }}" role="progressbar" style="width: {{ min($percentage, 100) }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="p-2 border rounded bg-light">
                                <small class="text-muted d-block">Budget Prévu</small>
                                <span class="fw-bold">{{ number_format($event->budget_allocated, 0, ',', ' ') }} CFA</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded {{ $percentage > 100 ? 'bg-light-danger border-danger' : 'bg-light' }}">
                                <small class="text-muted d-block">Dépenses Réelles</small>
                                <span class="fw-bold {{ $percentage > 100 ? 'text-danger' : '' }}">{{ number_format($event->actual_expenses, 0, ',', ' ') }} CFA</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.events.edit', $event->id) }}#budget-section" class="btn btn-outline-primary w-100 btn-sm">
                            <i class="fas fa-edit me-1"></i>Mettre à jour les dépenses
                        </a>
                    </div>
                @else
                    <div class="text-center py-3">
                        <p class="text-muted mb-0">Aucun budget défini pour cet événement.</p>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-link btn-sm">Définir un budget</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Infos Logistiques -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2 text-primary"></i>Détails Logistiques</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-clock me-2 text-muted"></i>Début</span>
                        <span class="fw-bold small">{{ $event->start_date->format('d/m/Y H:i') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-hourglass-end me-2 text-muted"></i>Fin</span>
                        <span class="fw-bold small">{{ $event->end_date ? $event->end_date->format('d/m/Y H:i') : 'Non définie' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-users me-2 text-muted"></i>Capacité</span>
                        <span class="fw-bold">{{ $event->max_participants ?: 'Illimitée' }}</span>
                    </li>
                    @if($event->max_participants)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-chair me-2 text-muted"></i>Places restantes</span>
                        <span class="badge {{ $event->remaining_places <= 5 ? 'bg-danger' : 'bg-success' }}">{{ $event->remaining_places }}</span>
                    </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-ticket-alt me-2 text-muted"></i>Frais</span>
                        <span class="fw-bold">{{ number_format($event->entry_fee, 0, ',', ' ') }} CFA</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Documents -->
        @if($event->technical_file)
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-file-pdf me-2 text-danger"></i>Documents</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center p-3 border rounded">
                    <div class="flex-shrink-0">
                        <i class="fas fa-file-archive fa-2x text-warning"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Dossier Technique</h6>
                        <small class="text-muted">Fiche technique / Artistes</small>
                    </div>
                    <a href="{{ asset('storage/' . $event->technical_file) }}" target="_blank" class="btn btn-sm btn-light border">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
