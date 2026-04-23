@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Projets de Production</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Liste des projets de production</h5>
            <div class="ms-auto">
                <a href="{{ route('admin.productions.monitoring') }}" class="btn btn-sm btn-outline-primary radius-30 px-3">
                    <i class="bi bi-speedometer2 me-1"></i>Suivi Technique
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="productionTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Artiste</th>
                        <th>Titre du projet</th>
                        <th>Type</th>
                        <th>Budget estimé</th>
                        <th>Statut</th>
                        <th>Date de soumission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productions as $production)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($production->user->photo ?? '')) }}" class="rounded-circle" width="40" height="40" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                <div class="ms-2">
                                    <h6 class="mb-0 font-14">{{ $production->user->name ?? 'Inconnu' }} {{ $production->user->last_name ?? '' }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{ $production->title }}</td>
                        <td>
                            <span class="badge bg-light-primary text-primary">{{ ucfirst($production->type) }}</span>
                        </td>
                        <td>{{ number_format($production->budget, 0, ',', ' ') }} FCFA</td>
                        <td>
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
                            <span class="badge {{ $statusClasses[$production->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$production->status] ?? $production->status }}
                            </span>
                        </td>
                        <td>{{ $production->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.productions.show', $production->uuid) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir les détails">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @if($production->attachment)
                                <a href="{{ asset('storage/' . $production->attachment) }}" target="_blank" class="text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Télécharger le dossier">
                                    <i class="bi bi-cloud-arrow-down-fill"></i>
                                </a>
                                @endif
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
        $(document).ready(function() {
            $('#productionTable').DataTable({
                order: [[5, 'desc']],
                dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                     '<"row"<"col-md-12"tr>>' +
                     '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
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
                    },
                    "select": {
                            "rows": {
                                "_": "%d lignes sélectionnées",
                                "0": "Aucune ligne sélectionnée",
                                "1": "1 ligne sélectionnée"
                            }
                    }
                }
            });
        });
    </script>
@endsection
