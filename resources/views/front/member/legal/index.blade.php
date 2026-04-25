@extends('front.layouts.app')

@section('title', 'Mes Conseils Juridiques - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/legal.jpeg';
        $title = 'Conseil Juridique';
        $breadcumb_table = ['Conseil Juridique'];
    @endphp
    @include('front.member.partials.slide_header')

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12 col-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Mes Consultations</h4>
                        <a href="{{ route('member.legal.create') }}" class="btn btn-sm btn_orange text-white rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-question-circle mr-1"></i> Poser une question
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="px-4 pt-2">
                                <div class="alert alert-success border-0 shadow-sm" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Sujet</th>
                                        <th class="border-0 py-3">Catégorie</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 py-3 text-right px-4">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($consultations as $item)
                                        <tr onclick="window.location='{{ route('member.legal.show', $item->uuid) }}'" style="cursor: pointer;">
                                            <td class="px-4 align-middle">
                                                <span class="font-weight-bold text-dark">{{ $item->subject }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @php
                                                    $categories = [
                                                        'copyright' => 'Droit d\'auteur',
                                                        'contract' => 'Contrats',
                                                        'social' => 'Social / Statut',
                                                        'tax' => 'Fiscalité',
                                                        'other' => 'Autre'
                                                    ];
                                                @endphp
                                                <small class="text-muted">{{ $categories[$item->category] ?? $item->category }}</small>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = [
                                                        'pending' => 'badge-warning text-white',
                                                        'in_progress' => 'badge-primary text-white',
                                                        'answered' => 'badge-success',
                                                        'closed' => 'badge-secondary'
                                                    ][$item->status] ?? 'badge-secondary';

                                                    $statusLabel = [
                                                        'pending' => 'En attente',
                                                        'in_progress' => 'En cours',
                                                        'answered' => 'Répondu',
                                                        'closed' => 'Fermé'
                                                    ][$item->status] ?? $item->status;
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-sm">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td class="px-4 align-middle text-right text-muted small">
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="py-4 text-muted">
                                                    <i class="fa fa-gavel fa-3x mb-3 text-light"></i>
                                                    <p>Vous n'avez pas encore de consultation juridique.</p>
                                                    <a href="{{ route('member.legal.create') }}" class="btn btn-sm btn-outline-orange rounded-pill mt-2">Poser ma première question</a>
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
    .btn-outline-orange { color: #fa584d; border-color: #fa584d; }
    .btn-outline-orange:hover { background-color: #fa584d; color: #fff; }
    .font-weight-bold { font-weight: 700 !important; }
</style>
@endsection
