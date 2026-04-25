@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Organisation</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Événements</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary radius-30 px-3">
            <i class="bi bi-plus-lg me-1"></i>Créer un événement
        </a>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Liste des événements</h5>
        </div>
        <div class="table-responsive">
            <table id="eventsTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Période</th>
                        <th>Lieu</th>
                        <th>Budget</th>
                        <th>Statut</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="rounded" width="40" height="40" style="object-fit: cover;" alt="">
                                @else
                                    <div class="bg-light text-secondary rounded d-flex align-items-center justify-content-center" width="40" height="40" style="width: 40px; height: 40px;">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                @endif
                                <div class="ms-2">
                                    <h6 class="mb-0 font-14">{{ $event->title }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-primary text-primary">{{ ucfirst($event->type) }}</span>
                        </td>
                        <td>
                            <div class="small">
                                <strong>Du:</strong> {{ $event->start_date->format('d/m/Y H:i') }}<br>
                                @if($event->end_date)
                                    <strong>Au:</strong> {{ $event->end_date->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-muted small">Non définie</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $event->location ?? 'N/A' }}</td>
                        <td>
                            @if($event->budget_allocated > 0)
                                <span class="text-{{ $event->actual_expenses > $event->budget_allocated ? 'danger' : 'success' }} small">
                                    {{ number_format($event->actual_expenses, 0, ',', ' ') }} / {{ number_format($event->budget_allocated, 0, ',', ' ') }}
                                </span>
                            @else
                                <span class="text-muted small">N/A</span>
                            @endif
                        </td>
                        <td>
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
                                    'open_registration' => 'Inscriptions',
                                    'ongoing' => 'En cours',
                                    'completed' => 'Terminé',
                                    'cancelled' => 'Annulé',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$event->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$event->status] ?? $event->status }}
                            </span>
                        </td>
                        <td>
                            @if($event->is_featured)
                                <span class="badge bg-light-warning text-warning"><i class="bi bi-star-fill me-1"></i>Oui</span>
                            @else
                                <span class="text-muted">Non</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.events.show', $event->id) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger bg-transparent border-0 p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer">
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
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection

@section('extra_css')
    <link href="{{asset('assets/admin/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <style>
        .dataTables_filter {
            text-align: right !important;
            margin-bottom: 0;
        }
    </style>
@endsection

@section('extra_js')
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#eventsTable').DataTable({
                order: [[2, 'desc']],
                paging: false,
                info: false,
                dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                     '<"row"<"col-md-12"tr>>',
                language: {
                    "sSearch": "Rechercher :"
                }
            });
        });
    </script>
@endsection
