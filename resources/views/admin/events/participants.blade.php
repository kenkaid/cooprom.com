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
                <li class="breadcrumb-item"><a href="{{ route('admin.events.show', $event->id) }}">Détails</a></li>
                <li class="breadcrumb-item active" aria-current="page">Participants</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-secondary px-3">
                <i class="bi bi-arrow-left me-1"></i>Retour aux détails
            </a>
            <button class="btn btn-success px-3">
                <i class="fas fa-file-excel me-1"></i>Exporter la liste
            </button>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fas fa-users me-2 text-primary"></i>Tous les participants pour : <span class="text-primary">{{ $event->title }}</span></h5>
        </div>

        <div class="table-responsive" style="overflow: visible;">
            <table class="table table-hover align-middle border">
                <thead class="bg-light">
                    <tr>
                        <th>Participant</th>
                        <th>Contact</th>
                        <th>Date d'inscription</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->photo }}" class="rounded-circle me-2" width="40" height="40" alt="">
                                <div>
                                    <div class="font-weight-bold">{{ $user->name }} {{ $user->last_name }}</div>
                                    <small class="text-muted">{{ $user->culturalSector->name ?? 'Membre' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small text-muted"><i class="fas fa-envelope me-1"></i>{{ $user->email }}</div>
                            <div class="small text-muted"><i class="fas fa-phone me-1"></i>{{ $user->phone_number }}</div>
                        </td>
                        <td>{{ $user->pivot->created_at->format('d/m/Y H:i') }}</td>
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

                            @if($user->pivot->notes)
                            <!-- Modal Notes -->
                            <div class="modal fade" id="notesModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Notes d'inscription : {{ $user->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-wrap" style="white-space: normal;">
                                            <p class="mb-0">{{ $user->pivot->notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3 d-block"></i>
                            Aucun participant trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $participants->links() }}
        </div>
    </div>
</div>
@endsection
