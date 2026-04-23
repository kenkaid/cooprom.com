@extends('front.layouts.app')

@section('title', 'Assurance Santé & Prévoyance - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Assurance Santé & Prévoyance</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.social.index') }}">Aide Sociale</a></li>
            <li>Assurances</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="row">
                    @forelse($insurances as $insurance)
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm rounded-lg h-100 overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-light text-info rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px;">
                                            <i class="fa fa-heartbeat fa-lg"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-weight-bold mb-0 text-dark">{{ $insurance->partner_name }}</h5>
                                            <span class="badge badge-light border text-muted px-2 py-1 small">{{ $insurance->insurance_type }}</span>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-4">{{ Str::limit($insurance->description, 120) }}</p>

                                    @if($insurance->coverage_details)
                                        <div class="bg-light p-3 rounded mb-4">
                                            <h6 class="font-weight-bold small mb-2"><i class="fa fa-shield-alt mr-2 text-info"></i> Couverture :</h6>
                                            <div class="small text-muted">{{ $insurance->coverage_details }}</div>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        @if($insurance->external_link)
                                            <a href="{{ $insurance->external_link }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-4">Plus d'infos</a>
                                        @endif
                                        <span class="text-muted small"><i class="fa fa-phone-alt mr-1"></i> {{ $insurance->contact_info ?? 'Contact Cooprom' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-lg p-5 text-center">
                                <i class="fa fa-hospital fa-4x text-light mb-3"></i>
                                <h5 class="text-muted">Aucun partenaire santé listé pour le moment</h5>
                                <p class="small text-muted">Revenez bientôt pour découvrir nos offres exclusives.</p>
                            </div>
                        </div>
                    @endforelse
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
</style>
@endsection
