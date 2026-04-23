@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Assistance & Conseil</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Conseil Juridique</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="legalTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Adhérent</th>
                        <th>Sujet</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date de demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $consultation)
                    <tr>
                        <td>
                            @if($consultation->user)
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $consultation->user->photo) }}" class="rounded-circle" width="44" height="44" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                    <div class="ms-2">
                                        <h6 class="mb-0">{{ $consultation->user->name }} {{ $consultation->user->last_name }}</h6>
                                    </div>
                                </div>
                            @else
                                <span class="text-danger">N/A</span>
                            @endif
                        </td>
                        <td>
                            <h6 class="mb-0">{{ Str::limit($consultation->subject, 40) }}</h6>
                            <small class="text-muted">UUID: {{ Str::limit($consultation->uuid, 8) }}</small>
                        </td>
                        <td>
                            @php
                                $categories = [
                                    'copyright' => 'Droit d\'auteur',
                                    'contract' => 'Contrats',
                                    'social' => 'Social / Statut',
                                    'tax' => 'Fiscalité',
                                    'other' => 'Autre'
                                ];
                            @endphp
                            <span class="badge bg-light-info text-info w-100">{{ $categories[$consultation->category] ?? $consultation->category }}</span>
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-light-warning text-warning',
                                    'in_progress' => 'bg-light-primary text-primary',
                                    'answered' => 'bg-light-success text-success',
                                    'closed' => 'bg-light-dark text-dark',
                                ];
                                $statusLabels = [
                                    'pending' => 'En attente',
                                    'in_progress' => 'En cours',
                                    'answered' => 'Répondu',
                                    'closed' => 'Clôturé',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$consultation->status] ?? 'bg-secondary' }} w-100">
                                {{ $statusLabels[$consultation->status] ?? $consultation->status }}
                            </span>
                        </td>
                        <td>{{ $consultation->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.legal-consultations.show', $consultation->uuid) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir"><i class="bi bi-eye-fill"></i></a>
                                <form action="{{ route('admin.legal-consultations.destroy', $consultation->uuid) }}" method="POST" onsubmit="return confirm('Supprimer cette demande ?');">
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
            $('#legalTable').DataTable({
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
                    }
                }
            });
        });
    </script>
@endsection
