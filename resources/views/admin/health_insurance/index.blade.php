@extends('admin.layouts.app')

@section('title', 'Assurance Santé & Prévoyance - COOPROM Admin')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Aide Sociale</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Assurance Santé</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.health-insurances.create') }}" class="btn btn-primary px-5 radius-30">
                <i class="bi bi-plus-circle-fill me-2"></i>Nouveau Partenaire
            </a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="insuranceTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Partenaire</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insurances as $insurance)
                    <tr>
                        <td>{{ $insurance->partner_name }}</td>
                        <td>{{ $insurance->insurance_type }}</td>
                        <td>
                            @if($insurance->is_active)
                                <span class="badge bg-light-success text-success">Actif</span>
                            @else
                                <span class="badge bg-light-danger text-danger">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.health-insurances.edit', $insurance->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{ route('admin.health-insurances.destroy', $insurance->id) }}" method="POST" onsubmit="return confirm('Supprimer ce partenaire ?');">
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
                var table = $('#insuranceTable').DataTable( {
                    dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                         '<"row"<"col-md-12"tr>>' +
                         '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
                    buttons: [ 'copy', 'excel', 'pdf', 'print'],
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
                } );
            } );
        });
    </script>
@endsection
