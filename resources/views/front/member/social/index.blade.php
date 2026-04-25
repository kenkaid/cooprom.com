@extends('front.layouts.app')

@section('title', 'Mon Aide Sociale - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/social.jpeg';
        $title = 'Mon Aide Sociale';
        $breadcumb_table = ['Aide Sociale'];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
                             role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Fonds de Solidarité -->
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-4">
                        <div
                            class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 font-weight-bold">Fonds de solidarité</h4>
                            <a href="{{ route('member.social.solidarity.create') }}"
                               class="btn btn-sm btn_orange text-white rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                                <i class="fa fa-hand-holding-heart mr-1"></i> Demander une aide
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Sujet</th>
                                        <th class="border-0 py-3">Montant</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 px-4 py-3 text-right">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($solidarityRequests as $request)
                                        <tr>
                                            <td class="px-4 align-middle font-weight-bold">{{ $request->subject }}</td>
                                            <td class="align-middle">{{ number_format($request->amount_requested, 0, ',', ' ') }}
                                                FCFA
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = ['pending' => 'badge-warning text-white', 'approved' => 'badge-success', 'rejected' => 'badge-danger'][$request->status] ?? 'badge-secondary';
                                                    $statusLabel = ['pending' => 'En attente', 'approved' => 'Approuvé', 'rejected' => 'Rejeté'][$request->status] ?? $request->status;
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-sm">{{ $statusLabel }}</span>
                                            </td>
                                            <td class="px-4 align-middle text-right text-muted small">{{ $request->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">Aucune demande
                                                effectuée
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Accompagnement Retraite -->
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-4">
                        <div
                            class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 font-weight-bold">Accompagnement Retraite</h4>
                            <a href="{{ route('member.social.retirement.create') }}"
                               class="btn btn-sm btn-outline-orange rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                                <i class="fa fa-calculator mr-1"></i> Nouvelle simulation
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Âge actuel</th>
                                        <th class="border-0 py-3">Départ visé</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 px-4 py-3 text-right">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($retirementSimulations as $sim)
                                        <tr>
                                            <td class="px-4 align-middle">{{ $sim->current_age }} ans</td>
                                            <td class="align-middle">{{ $sim->target_retirement_age }} ans</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="badge badge-info px-3 py-2 rounded-pill text-white">{{ ucfirst($sim->status) }}</span>
                                            </td>
                                            <td class="px-4 align-middle text-right text-muted small">{{ $sim->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">Aucun dossier en
                                                cours
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Assurance Santé (Quick Link) -->
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden border-left-info"
                         style="border-left: 5px solid #17a2b8 !important;">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="font-weight-bold mb-1">Assurance Santé & Prévoyance</h5>
                                <p class="mb-0 text-muted small">Consultez nos partenaires et vos avantages santé.</p>
                            </div>
                            <a href="{{ route('member.social.health.index') }}" class="btn btn-info rounded-pill px-4">Voir
                                les offres</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
    <style>
        .rounded-lg {
            border-radius: 15px !important;
        }

        .btn_orange {
            background-color: #fa584d;
            border: none;
        }

        .btn_orange:hover {
            background-color: #e64b42;
            color: #fff;
        }

        .btn-outline-orange {
            color: #fa584d;
            border: #fa584d 1px solid;
        }

        .btn-outline-orange:hover {
            background: #fa584d;
            color: #fff;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }
    </style>
@endsection
