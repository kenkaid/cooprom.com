@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Équipe</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Membres</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary px-5 radius-30">
                <i class="bi bi-person-plus-fill me-2"></i>Nouveau Membre
            </a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="teamTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Désignation</th>
                        <th>Réseaux Sociaux</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $member)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $member->photo) }}" class="rounded-circle" width="44" height="44" alt="" onerror="this.src='{{ asset('assets/admin/images/avatars/avatar-1.png') }}'">
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $member->name }} {{ $member->last_name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{ $member->designation }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($member->facebook) <a href="{{ $member->facebook }}" target="_blank" class="text-primary"><i class="bi bi-facebook"></i></a> @endif
                                @if($member->twitter) <a href="{{ $member->twitter }}" target="_blank" class="text-info"><i class="bi bi-twitter"></i></a> @endif
                                @if($member->linkedin) <a href="{{ $member->linkedin }}" target="_blank" class="text-primary"><i class="bi bi-linkedin"></i></a> @endif
                                @if($member->vimeo) <a href="{{ $member->vimeo }}" target="_blank" class="text-danger"><i class="bi bi-vimeo"></i></a> @endif
                            </div>
                        </td>
                        <td>
                            @if($member->status == 1)
                                <span class="badge bg-light-success text-success w-100">Actif</span>
                            @else
                                <span class="badge bg-light-danger text-danger w-100">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.teams.edit', $member->uuid) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{ route('admin.teams.destroy', $member->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
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
@endsection

@section('extra_js')
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(function() {
            "use strict";
            $(document).ready(function() {
                var table = $('#teamTable').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel', 'pdf', 'print']
                } );

                table.buttons().container()
                    .appendTo( '#teamTable_wrapper .col-md-6:eq(0)' );
            } );
        });
    </script>
@endsection
