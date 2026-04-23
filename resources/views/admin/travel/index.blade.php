@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Voyages & Mobilité</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.travels.create') }}" class="btn btn-primary">Nouveau Voyage</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Liste des voyages organisés</h5>
        </div>
        <div class="table-responsive">
            <table id="travelTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Destination</th>
                        <th>Départ</th>
                        <th>Retour</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travels as $travel)
                    <tr>
                        <td>{{ $travel->title }}</td>
                        <td>{{ $travel->destination }}</td>
                        <td>{{ $travel->departure_date instanceof \Carbon\Carbon ? $travel->departure_date->format('d/m/Y') : \Carbon\Carbon::parse($travel->departure_date)->format('d/m/Y') }}</td>
                        <td>{{ $travel->return_date ? ($travel->return_date instanceof \Carbon\Carbon ? $travel->return_date->format('d/m/Y') : \Carbon\Carbon::parse($travel->return_date)->format('d/m/Y')) : 'N/A' }}</td>
                        <td>
                            <span class="badge bg-light-info text-info">{{ $travel->type == 'group' ? 'Groupe' : 'Individuel' }}</span>
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'planned' => 'bg-light-warning text-warning',
                                    'ongoing' => 'bg-light-info text-info',
                                    'completed' => 'bg-light-success text-success',
                                    'cancelled' => 'bg-light-danger text-danger',
                                ];
                                $statusLabels = [
                                    'planned' => 'Planifié',
                                    'ongoing' => 'En cours',
                                    'completed' => 'Terminé',
                                    'cancelled' => 'Annulé',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$travel->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$travel->status] ?? $travel->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.travels.edit', $travel->uuid) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.travels.destroy', $travel->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce voyage ?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger border-0 bg-transparent">
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
            $('#travelTable').DataTable({
                dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                     '<"row"<"col-md-12"tr>>' +
                     '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
                language: {
                    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                    "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                    "sLengthMenu":     "Afficher l'élément _MENU_",
                    "sSearch":         "Rechercher :",
                    "oPaginate": {
                        "sFirst":    "Premier",
                        "sLast":     "Dernier",
                        "sNext":     "Suivant",
                        "sPrevious": "Précédent"
                    }
                }
            });
        });
    </script>
@endsection
