@extends('front.layouts.app')

@section('title', 'Mes Voyages & Visas - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Mes Voyages & Visas</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li>Voyages</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Mes Demandes de Visas & Mobilité</h4>
                        <a href="{{ route('member.travels.create_visa') }}" class="btn btn-sm btn_orange text-white rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-passport mr-1"></i> Nouvelle Demande
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="px-4 pt-2">
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Destination</th>
                                        <th class="border-0 py-3">Type de Visa</th>
                                        <th class="border-0 py-3">Contexte</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 py-3 text-center">Actions</th>
                                        <th class="border-0 px-4 py-3 text-right">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($visaApplications as $visa)
                                        <tr>
                                            <td class="px-4 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3 bg-light p-2 rounded text-info">
                                                        <i class="fa fa-globe-americas"></i>
                                                    </div>
                                                    <span class="font-weight-bold">{{ $visa->country }}</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $visa->visa_type }}</td>
                                            <td class="align-middle text-muted small">
                                                {{ $visa->travel ? $visa->travel->title : 'Assistance Individuelle' }}
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = [
                                                        'pending' => 'badge-warning text-white',
                                                        'submitted' => 'badge-info text-white',
                                                        'approved' => 'badge-success',
                                                        'rejected' => 'badge-danger'
                                                    ][$visa->status] ?? 'badge-secondary';

                                                    $statusLabel = [
                                                        'pending' => 'En attente',
                                                        'submitted' => 'Déposée',
                                                        'approved' => 'Accordé',
                                                        'rejected' => 'Refusé'
                                                    ][$visa->status] ?? $visa->status;
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-sm" style="cursor: help;"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="{{ $visa->admin_note ?? 'Aucune note pour le moment.' }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($visa->status === 'pending')
                                                    <a href="{{ route('member.travels.edit_visa', $visa->uuid) }}" class="btn btn-sm btn-light rounded-circle mx-1 text-info" title="Modifier">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @include('front.member.travels.delete')
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 align-middle text-right text-muted small">
                                                {{ $visa->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4">
                                                    <i class="fa fa-plane-departure fa-4x text-light mb-3"></i>
                                                    <h5 class="text-muted">Aucune demande de voyage</h5>
                                                    <p class="small text-muted">Prévoyez votre prochaine mobilité internationale avec la COOPROM.</p>
                                                    <a href="{{ route('member.travels.create_visa') }}" class="btn btn-sm btn-outline-orange rounded-pill mt-3 px-4">
                                                        Nouvelle demande d'assistance
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .text_orange { color: #fa584d !important; }
    .font-weight-bold { font-weight: 700 !important; }
    .btn-outline-orange {
        color: #fa584d;
        border-color: #fa584d;
    }
    .btn-outline-orange:hover {
        background-color: #fa584d;
        color: #fff;
    }
</style>
@endsection

@section('extra_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover({
            trigger: 'hover'
        });
    })
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fa584d',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
