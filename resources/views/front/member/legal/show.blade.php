@extends('front.layouts.app')

@section('title', 'Détails Consultation - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Conseil Juridique</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('member.legal.index') }}">Conseil Juridique</a></li>
            <li>Détails</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-4">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">{{ $consultation->subject }}</h4>
                        @php
                            $statusClass = [
                                'pending' => 'badge-warning text-white',
                                'in_progress' => 'badge-primary text-white',
                                'answered' => 'badge-success',
                                'closed' => 'badge-secondary'
                            ][$consultation->status] ?? 'badge-secondary';

                            $statusLabel = [
                                'pending' => 'En attente',
                                'in_progress' => 'En cours',
                                'answered' => 'Répondu',
                                'closed' => 'Fermé'
                            ][$consultation->status] ?? $consultation->status;
                        @endphp
                        <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-sm">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h6 class="font-weight-bold text-muted small text-uppercase">Votre question :</h6>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($consultation->message)) !!}
                            </div>
                            <small class="text-muted">Posté le {{ $consultation->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        <hr>

                        @if($consultation->admin_response)
                            <div class="mt-4">
                                <h6 class="font-weight-bold text-orange small text-uppercase"><i class="fa fa-comment-dots mr-2"></i>Réponse de la COOPROM :</h6>
                                <div class="p-4 border rounded shadow-sm bg-white" style="border-left: 5px solid #fa584d !important;">
                                    {!! nl2br(e($consultation->admin_response)) !!}
                                    <div class="mt-3 pt-3 border-top text-muted small">
                                        Par un expert juridique, le {{ $consultation->answered_at ? $consultation->answered_at->format('d/m/Y H:i') : $consultation->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-4 p-4 text-center bg-light rounded">
                                <i class="fa fa-clock fa-2x text-muted mb-2"></i>
                                <p class="mb-0 text-muted">Votre demande est en cours de traitement par notre équipe juridique. Vous recevrez une notification dès qu'une réponse sera apportée.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('member.legal.index') }}" class="btn btn-outline-orange rounded-pill px-4">
                        <i class="fa fa-arrow-left mr-2"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .text-orange { color: #fa584d !important; }
    .btn-outline-orange { color: #fa584d; border-color: #fa584d; }
    .btn-outline-orange:hover { background-color: #fa584d; color: #fff; }
    .font-weight-bold { font-weight: 700 !important; }
</style>
@endsection
