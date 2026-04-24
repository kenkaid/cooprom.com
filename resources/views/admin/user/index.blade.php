@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Utilisateurs</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-5 radius-30">
                <i class="bi bi-person-plus-fill me-2"></i>Nouvel Utilisateur
            </a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom & Prénom</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>Secteur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->photo }}" class="rounded-circle" width="44" height="44" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $user->name }} {{ $user->last_name }}</h6>
                                    @if($user->designation)
                                        <small class="text-muted">{{ $user->designation }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="roles-container">
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary py-0 px-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editRolesModal"
                                        data-user-uuid="{{ $user->uuid }}"
                                        data-user-name="{{ $user->name }} {{ $user->last_name }}"
                                        data-user-roles="{{ json_encode($user->roles->pluck('name')) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-info text-info w-100">{{ $user->culturalSector->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.users.edit', $user->uuid) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{ route('admin.users.destroy', $user->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
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

<!-- Modal pour modifier les rôles -->
<div class="modal fade" id="editRolesModal" tabindex="-1" aria-labelledby="editRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editRolesForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editRolesModalLabel">Modifier les rôles de <span id="modalUserName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sélectionnez les rôles</label>
                        <select name="roles[]" id="userRolesSelect" class="form-select" multiple size="{{ count($roles) }}">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs rôles.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

            const editRolesModal = document.getElementById('editRolesModal');
            if (editRolesModal) {
                editRolesModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    const userUuid = button.getAttribute('data-user-uuid');
                    const userName = button.getAttribute('data-user-name');
                    const userRoles = JSON.parse(button.getAttribute('data-user-roles'));

                    const modalTitle = editRolesModal.querySelector('#modalUserName');
                    const form = editRolesModal.querySelector('#editRolesForm');
                    const select = editRolesModal.querySelector('#userRolesSelect');

                    modalTitle.textContent = userName;
                    form.action = `/cp-admin-access/users/${userUuid}/roles`;

                    // Reset and set selected roles
                    Array.from(select.options).forEach(option => {
                        option.selected = userRoles.includes(option.value);
                    });
                });
            }

            $(document).ready(function() {
                var table = $('#userTable').DataTable( {
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
