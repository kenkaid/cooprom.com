@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configuration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Attributs Dynamiques (EAV)</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary px-5 radius-30">
                <i class="bi bi-plus-circle-fill me-2"></i>Nouvel Attribut
            </a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="attributes-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Label</th>
                        <th>Type</th>
                        <th>Rôles</th>
                        <th>Secteurs</th>
                        <th>Obligatoire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->order_column }}</td>
                        <td>{{ $attribute->label }} <br><small class="text-muted">({{ $attribute->name }})</small></td>
                        <td><span class="badge bg-light-info text-info">{{ strtoupper($attribute->type) }}</span></td>
                        <td>
                            @if($attribute->allowed_roles)
                                @foreach(explode(',', $attribute->allowed_roles) as $role)
                                    <span class="badge bg-light-primary text-primary">{{ ucfirst($role) }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-light-secondary text-secondary">Tous</span>
                            @endif
                        </td>
                        <td>
                            @if($attribute->culturalSectors->count() > 0)
                                @foreach($attribute->culturalSectors as $sector)
                                    <span class="badge bg-light-success text-success">{{ $sector->name }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-light-secondary text-secondary">Tous</span>
                            @endif
                        </td>
                        <td>
                            @if($attribute->is_required)
                                <span class="badge bg-light-danger text-danger">Oui</span>
                            @else
                                <span class="badge bg-light-secondary text-secondary">Non</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.attributes.edit', $attribute->uuid) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{ route('admin.attributes.destroy', $attribute->uuid) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet attribut ?')">
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
    </style>
@endsection

@section('extra_js')
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(function() {
            "use strict";
            $(document).ready(function() {
                $('#attributes-table').DataTable({
                    dom: '<"row mb-3 align-items-center"<"col-md-6"l><"col-md-6 text-end"f>>' +
                         '<"row"<"col-md-12"tr>>' +
                         '<"row mt-3 align-items-center"<"col-md-5"i><"col-md-7 d-flex justify-content-end"p>>',
                    language: {
                        "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                        "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                        "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
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
        });
    </script>
@endsection
