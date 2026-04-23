@extends('admin.layouts.app')

@section('title', 'Gestion des Contrats - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Opérations Métiers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les contrats</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.contracts.create') }}" class="btn btn-primary radius-30">
                    <i class="bi bi-plus-circle-fill me-2"></i>Nouveau Contrat
                </a>
                <a href="{{ route('admin.contracts.templates') }}" class="btn btn-outline-primary ms-2 radius-30">
                    <i class="bi bi-file-earmark-text me-2"></i>Modèles types
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Liste des Contrats</h5>
            </div>
            <hr/>
            <div class="table-responsive">
                <table id="contractTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Titre du Contrat</th>
                            <th>Type</th>
                            <th>Lié à (Projet/Mission)</th>
                            <th>Adhérent</th>
                            <th>Statut</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0">{{ $contract->title }}</h6>
                                            <small class="text-muted">UUID: {{ Str::limit($contract->uuid, 8) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
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
                                    <span class="badge bg-light-secondary text-secondary">{{ $typeLabels[$contract->type] ?? ucfirst($contract->type) }}</span>
                                </td>
                                <td>
                                    @if($contract->contractable)
                                        @if($contract->contractable_type === 'App\Models\Production')
                                            <span class="badge bg-light-info text-info">
                                                <i class="bi bi-music-note-beamed me-1"></i> {{ $contract->contractable->title }}
                                            </span>
                                        @elseif($contract->contractable_type === 'App\Models\VisaApplication')
                                            <span class="badge bg-light-primary text-primary">
                                                <i class="bi bi-airplane-fill me-1"></i> Visa: {{ $contract->contractable->travel ? $contract->contractable->travel->destination : 'Mission' }}
                                            </span>
                                        @else
                                            <span class="badge bg-light-secondary text-secondary">{{ class_basename($contract->contractable_type) }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">Aucune liaison</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contract->user)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $contract->user->photo) }}" class="rounded-circle" width="35" height="35" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                            <div class="ms-2">
                                                <small>{{ $contract->user->name }} {{ $contract->user->last_name }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-danger">N/A</span>
                                    @endif
                                </td>
                                <td>
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
                                    <span class="badge {{ $statusClasses[$contract->status] ?? 'bg-secondary' }} radius-30">
                                        {{ $statusLabels[$contract->status] ?? $contract->status }}
                                    </span>
                                </td>
                                <td>
                                    <small>
                                        Du : {{ $contract->start_date ? \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') : 'N/A' }}<br>
                                        Au : {{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') : 'N/A' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('admin.contracts.show', $contract) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir"><i class="bi bi-eye-fill"></i></a>
                                        <a href="{{ route('admin.contracts.edit', $contract) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="bi bi-pencil-fill"></i></a>
                                        <form action="{{ route('admin.contracts.destroy', $contract) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger bg-transparent border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        .dataTables_filter label {
            display: inline-flex;
            align-items: center;
        }
        .dataTables_filter input {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
        }
    </style>
@endsection

@section('extra_js')
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(function() {
            "use strict";
            $(document).ready(function() {
                $('#contractTable').DataTable({
                    language: {
                        "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                        "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                        "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "Afficher l'élément _MENU_",
                        "sLoadingRecords": "Chargement...",
                        "sProcessing":     "Traitement...",
                        "sSearch":         "Rechercher :",
                        "sZeroRecords":    "Aucun élément correspondant trouvé",
                        "oPaginate": {
                            "sFirst":    "Premier",
                            "sLast":     "Dernier",
                            "sNext":     "Suivant",
                            "sPrevious": "Précédent"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                    dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                         '<"row"<"col-md-12"tr>>' +
                         '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
                });
            });
        });
    </script>
@endsection
