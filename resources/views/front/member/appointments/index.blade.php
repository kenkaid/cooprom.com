@extends('front.layouts.app')

@section('title', 'Mes Rendez-vous - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Mes Rendez-vous</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li>Rendez-vous</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0">
                        <h4 class="mb-0 font-weight-bold">Mes Rendez-vous & Agenda</h4>
                        <p class="text-muted small mb-0">Retrouvez ici vos dates de rendez-vous pour la remise de documents ou entretiens.</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Objet / Motif</th>
                                        <th class="border-0 py-3 text-center">Date & Heure</th>
                                        <th class="border-0 py-3 text-center">Lieu</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 px-4 py-3 text-right">Dossier lié</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($appointments as $appointment)
                                        <tr>
                                            <td class="px-4 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3 bg-light p-2 rounded text-primary">
                                                        <i class="fa fa-calendar-check"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold d-block">{{ $appointment->title }}</span>
                                                        @if($appointment->description)
                                                            <small class="text-muted">{{ Str::limit($appointment->description, 40) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="text_orange font-weight-bold">
                                                    {{ $appointment->appointment_date->format('d/m/Y') }}
                                                </div>
                                                <div class="small text-muted">
                                                    {{ $appointment->appointment_date->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="align-middle text-center small">
                                                {{ $appointment->location ?? 'Siège COOPROM' }}
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = [
                                                        'scheduled' => 'badge-primary',
                                                        'completed' => 'badge-success',
                                                        'cancelled' => 'badge-danger'
                                                    ][$appointment->status] ?? 'badge-secondary';

                                                    $statusLabel = [
                                                        'scheduled' => 'Programmé',
                                                        'completed' => 'Terminé',
                                                        'cancelled' => 'Annulé'
                                                    ][$appointment->status] ?? $appointment->status;
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-sm">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td class="px-4 align-middle text-right">
                                                @if($appointment->appointmentable)
                                                    <small class="text-muted d-block">
                                                        {{ class_basename($appointment->appointmentable_type) }}
                                                    </small>
                                                    <span class="font-weight-bold small">
                                                        @if($appointment->appointmentable_type == 'App\Models\VisaApplication')
                                                            {{ $appointment->appointmentable->country }}
                                                        @else
                                                            {{ $appointment->appointmentable->title }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4">
                                                    <i class="fa fa-calendar-alt fa-4x text-light mb-3"></i>
                                                    <h5 class="text-muted">Aucun rendez-vous programmé</h5>
                                                    <p class="small text-muted">L'administration vous contactera pour fixer vos prochains rendez-vous.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 p-4">
                        {{ $appointments->links() }}
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
    .text_orange { color: #fa584d !important; }
    .font-weight-bold { font-weight: 700 !important; }
</style>
@endsection
