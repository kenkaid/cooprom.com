@extends('admin.layouts.app')

@section('title', 'Demandes de Visa - COOPROM Admin')

@section('content')
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

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Demandes de Visa</h5>
            </div>
            <hr/>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Candidat</th>
                            <th>Destination</th>
                            <th>Type de Visa</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visas as $visa)
                            <tr>
                                <td>{{ $visa->user->name ?? 'N/A' }}</td>
                                <td>{{ $visa->destination }}</td>
                                <td>{{ $visa->visa_type }}</td>
                                <td>
                                    <span class="badge bg-light-warning text-warning">{{ $visa->status }}</span>
                                </td>
                                <td>{{ $visa->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="#" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voir"><i class="bi bi-eye-fill"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune demande de visa trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
