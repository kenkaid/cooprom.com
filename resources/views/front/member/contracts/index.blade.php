@extends('front.layouts.app')

@section('title', 'Mes Contrats - COOPROM')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/resource/members/contracts.jpeg') }});">
    <div class="auto-container">
        <h1 class="text-white">Mes Contrats</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Tableau de bord</a></li>
            <li>Contrats</li>
        </ul>
    </div>
</section>

<!-- Dashboard Section -->
<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <!-- Contenu Principal -->
            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Liste de mes contrats</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Réf.</th>
                                        <th class="border-0 py-3">Type</th>
                                        <th class="border-0 py-3">Date réception</th>
                                        <th class="border-0 py-3">Date signature</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 px-4 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contracts as $contract)
                                        <tr>
                                            <td class="px-4 align-middle">#{{ substr($contract->uuid, 0, 8) }}</td>
                                            <td class="align-middle font-weight-bold">{{ $contract->type }}</td>
                                            <td class="align-middle">{{ $contract->created_at ? $contract->created_at->format('d/m/Y') : '-' }}</td>
                                            <td class="align-middle">{{ ($contract->status == 'signed' && $contract->start_date) ? \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') : '-' }}</td>
                                            <td class="align-middle text-center">
                                                @if($contract->status == 'signed')
                                                    <span class="badge badge-success px-3 py-2">Signé</span>
                                                @elseif($contract->status == 'draft')
                                                    <span class="badge badge-warning px-3 py-2 text-white">Brouillon</span>
                                                @elseif($contract->status == 'expired')
                                                    <span class="badge badge-danger px-3 py-2">Expiré</span>
                                                @elseif($contract->status == 'cancelled')
                                                    <span class="badge badge-dark px-3 py-2">Annulé</span>
                                                @else
                                                    <span class="badge badge-secondary px-3 py-2">{{ ucfirst($contract->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="px-4 align-middle text-right">
                                                <a href="{{ route('member.contracts.show', $contract->uuid) }}" class="btn btn-sm btn-outline-orange rounded-pill">
                                                    <i class="fa fa-eye mr-1"></i> Consulter
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="py-4">
                                                    <i class="fa fa-file-contract fa-4x text-light mb-3"></i>
                                                    <h5 class="text-muted">Aucun contrat trouvé</h5>
                                                    <p class="small text-muted">Vos contrats apparaîtront ici dès qu'ils seront édités par la COOPROM.</p>
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
    .font-weight-bold { font-weight: 700 !important; }
    .btn-outline-orange {
        color: #fa584d;
        border-color: #fa584d;
    }
    .btn-outline-orange:hover {
        background-color: #fa584d;
        color: #fff;
    }
    .badge-success { background-color: #28a745; }
    .badge-warning { background-color: #ffc107; }
    .badge-danger { background-color: #dc3545; }
    .badge-dark { background-color: #343a40; }
</style>
@endsection
