@extends('admin.layouts.app')

@section('title', 'Gestion de l\'Agenda - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Opérations Métiers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agenda & Rendez-vous</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary radius-30">
                    <i class="bi bi-calendar-plus-fill me-2"></i>Nouveau RDV
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Liste des Rendez-vous</h5>
            </div>
            <hr/>
            <div class="table-responsive">
                <table id="appointmentTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Titre / Objet</th>
                            <th>Adhérent</th>
                            <th>Date & Heure</th>
                            <th>Lieu</th>
                            <th>Lié à</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>
                                    <h6 class="mb-0">{{ $appointment->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($appointment->description, 50) }}</small>
                                </td>
                                <td>
                                    @if($appointment->user)
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0">{{ $appointment->user->name }} {{ $appointment->user->last_name }}</h6>
                                                <small class="text-muted">{{ $appointment->user->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-danger">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center text-primary">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        <span>{{ $appointment->appointment_date->format('d/m/Y H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <small>{{ $appointment->location ?? 'Non spécifié' }}</small>
                                </td>
                                <td>
                                    @if($appointment->appointmentable)
                                        <span class="badge bg-light-info text-info">
                                            {{ class_basename($appointment->appointmentable_type) }}:
                                            @if($appointment->appointmentable_type == 'App\Models\VisaApplication')
                                                {{ $appointment->appointmentable->country }}
                                            @else
                                                {{ $appointment->appointmentable->title ?? $appointment->appointmentable->id }}
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-muted">Aucun lien</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'scheduled' => 'bg-light-primary text-primary',
                                            'completed' => 'bg-light-success text-success',
                                            'cancelled' => 'bg-light-danger text-danger',
                                        ];
                                        $statusLabels = [
                                            'scheduled' => 'Programmé',
                                            'completed' => 'Terminé',
                                            'cancelled' => 'Annulé',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusClasses[$appointment->status] ?? 'bg-light-secondary' }}">
                                        {{ $statusLabels[$appointment->status] ?? $appointment->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('admin.appointments.edit', $appointment->uuid) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.appointments.destroy', $appointment->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger bg-transparent border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
@endsection
