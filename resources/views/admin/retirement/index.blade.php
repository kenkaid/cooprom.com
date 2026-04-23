@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Aide Sociale</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Accompagnement Retraite</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="retirementTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Âge actuel</th>
                        <th>Âge départ visé</th>
                        <th>Pension est.</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($simulations as $simulation)
                    <tr>
                        <td>{{ $simulation->user->name }}</td>
                        <td>{{ $simulation->current_age ?? '-' }} ans</td>
                        <td>{{ $simulation->target_retirement_age ?? '-' }} ans</td>
                        <td>{{ $simulation->estimated_monthly_pension ? number_format($simulation->estimated_monthly_pension, 0, ',', ' ') . ' FCFA' : '-' }}</td>
                        <td>
                            @if($simulation->status == 'draft')
                                <span class="badge bg-light-secondary text-secondary w-100">Brouillon</span>
                            @elseif($simulation->status == 'submitted')
                                <span class="badge bg-light-warning text-warning w-100">Soumis</span>
                            @else
                                <span class="badge bg-light-success text-success w-100">Traité</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.retirement-simulations.show', $simulation->id) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('admin.retirement-simulations.edit', $simulation->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Traiter"><i class="bi bi-pencil-fill"></i></a>
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
            $('#retirementTable').DataTable({
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
