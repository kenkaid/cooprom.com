@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Demandes de Visa</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">Liste des demandes de visa</h5>
        </div>
        <div class="table-responsive">
            <table id="visaTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Artiste</th>
                        <th>Pays</th>
                        <th>Type de Visa</th>
                        <th>Voyage Lié</th>
                        <th>Statut</th>
                        <th>Date de demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visas as $visa)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($visa->user->photo ?? '')) }}" class="rounded-circle" width="40" height="40" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                <div class="ms-2">
                                    <h6 class="mb-0 font-14">{{ $visa->user->name ?? 'Inconnu' }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{ $visa->country }}</td>
                        <td>{{ $visa->visa_type }}</td>
                        <td>
                            @if($visa->travel)
                                <span class="text-primary">{{ $visa->travel->title }}</span>
                            @else
                                <span class="text-muted">Individuel</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-light-warning text-warning',
                                    'submitted' => 'bg-light-info text-info',
                                    'approved' => 'bg-light-success text-success',
                                    'rejected' => 'bg-light-danger text-danger',
                                ];
                                $statusLabels = [
                                    'pending' => 'En attente',
                                    'submitted' => 'Déposée',
                                    'approved' => 'Accordée',
                                    'rejected' => 'Refusée',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$visa->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$visa->status] ?? $visa->status }}
                            </span>
                        </td>
                        <td>{{ $visa->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.visa_applications.show', $visa->uuid) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gérer la demande">
                                    <i class="bi bi-gear-fill"></i>
                                </a>
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
            $('#visaTable').DataTable({
                dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                     '<"row"<"col-md-12"tr>>' +
                     '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
                language: {
                    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
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
