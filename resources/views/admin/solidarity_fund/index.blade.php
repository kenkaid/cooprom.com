@extends('admin.layouts.app')

@section('title', 'Fonds de Solidarité - COOPROM Admin')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Aide Sociale</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Fonds de solidarité</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="solidarityTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Sujet</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->subject }}</td>
                        <td>{{ number_format($request->amount_requested, 0, ',', ' ') }} FCFA</td>
                        <td>
                            @if($request->status == 'pending')
                                <span class="badge bg-light-warning text-warning">En attente</span>
                            @elseif($request->status == 'approved')
                                <span class="badge bg-light-success text-success">Approuvé</span>
                            @else
                                <span class="badge bg-light-danger text-danger">Rejeté</span>
                            @endif
                        </td>
                        <td>{{ $request->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.solidarity-fund.show', $request->id) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('admin.solidarity-fund.edit', $request->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Traiter"><i class="bi bi-pencil-fill"></i></a>
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
        $(document).ready(function() {
            $('#solidarityTable').DataTable({
                language: {
                    "sSearch": "Rechercher :",
                    "oPaginate": { "sNext": "Suivant", "sPrevious": "Précédent" }
                },
                dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>t<"row mt-3"<"col-md-5"i><"col-md-7"p>>',
            });
        });
    </script>
@endsection
