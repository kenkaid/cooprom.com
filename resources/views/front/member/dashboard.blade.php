@extends('front.layouts.app')

@section('title', 'Tableau de bord Adhérent - COOPROM')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Mon Espace Adhérent</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li>Tableau de bord</li>
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
                <div class="welcome-box mb-4 p-4 rounded-lg bg-white shadow-sm border-left-orange">
                    <div class="d-flex align-items-center">
                        <div class="icon-box mr-4 bg-light p-3 rounded-circle">
                            <i class="fa fa-hand-sparkles fa-2x text_orange"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 font-weight-bold">Ravi de vous revoir, {{ auth()->user()->name }} !</h3>
                            <p class="mb-0 text-muted">Voici un aperçu de vos activités récentes au sein de la COOPROM.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Stats / Quick Links -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm transition-hover">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="p-3 rounded-lg bg-orange-light">
                                        <i class="fa fa-file-contract text_orange fa-lg"></i>
                                    </div>
                                    <span class="h2 mb-0 font-weight-bold">{{ $stats['contracts'] ?? 0 }}</span>
                                </div>
                                <h6 class="text-muted font-weight-bold mb-0">Contrats actifs</h6>
                                <small class="text-muted">Engagements juridiques</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm transition-hover">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="p-3 rounded-lg bg-blue-light">
                                        <i class="fa fa-compact-disc text-primary fa-lg"></i>
                                    </div>
                                    <span class="h2 mb-0 font-weight-bold">{{ $stats['productions'] ?? 0 }}</span>
                                </div>
                                <h6 class="text-muted font-weight-bold mb-0">Productions</h6>
                                <small class="text-muted">Projets en cours</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm transition-hover">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="p-3 rounded-lg bg-green-light">
                                        <i class="fa fa-globe-africa text-success fa-lg"></i>
                                    </div>
                                    <span class="h2 mb-0 font-weight-bold">{{ $stats['visas'] ?? 0 }}</span>
                                </div>
                                <h6 class="text-muted font-weight-bold mb-0">Mobilité</h6>
                                <small class="text-muted">Voyages & Visas</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-8 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-header bg-white border-0 p-4">
                                <h5 class="mb-0 font-weight-bold">Actions recommandées</h5>
                            </div>
                            <div class="card-body px-4 pb-4 pt-0">
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('member.productions.create') }}" class="list-group-item list-group-item-action border-0 rounded mb-2 bg-light d-flex align-items-center p-3">
                                        <div class="mr-3 bg-white p-2 rounded shadow-sm text_orange">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">Lancer un nouveau projet de production</h6>
                                            <small class="text-muted">Clips, albums, films, galeries virtuelles...</small>
                                        </div>
                                        <i class="fa fa-chevron-right ml-auto text-muted small"></i>
                                    </a>
                                    <a href="{{ route('member.travels.create_visa') }}" class="list-group-item list-group-item-action border-0 rounded mb-2 bg-light d-flex align-items-center p-3">
                                        <div class="mr-3 bg-white p-2 rounded shadow-sm text-info">
                                            <i class="fa fa-passport"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">Demander une assistance visa</h6>
                                            <small class="text-muted">Accompagnement pour vos démarches consulaires</small>
                                        </div>
                                        <i class="fa fa-chevron-right ml-auto text-muted small"></i>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0 rounded bg-light d-flex align-items-center p-3">
                                        <div class="mr-3 bg-white p-2 rounded shadow-sm text-secondary">
                                            <i class="fa fa-gavel"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">Conseil juridique</h6>
                                            <small class="text-muted">Assistance pour vos contrats externes</small>
                                        </div>
                                        <i class="fa fa-chevron-right ml-auto text-muted small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg bg_orange text-white h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                                <i class="fa fa-id-card fa-3x mb-3"></i>
                                <h5 class="font-weight-bold mb-3">Adhésion Complète</h5>
                                <p class="small mb-4">Votre profil est à jour. Vous bénéficiez de tous les avantages de la COOPROM.</p>
                                <a href="{{ route('member.profile.edit') }}" class="btn btn-light btn-sm font-weight-bold py-2 rounded-pill shadow-sm">
                                    Gérer mon profil
                                </a>
                            </div>
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
    .bg_orange { background-color: #fa584d !important; }
    .text_orange { color: #fa584d !important; }
    .bg-orange-light { background-color: #fff5f4; }
    .bg-blue-light { background-color: #eef7ff; }
    .bg-green-light { background-color: #f0fff4; }
    .rounded-lg { border-radius: 15px !important; }
    .border-left-orange { border-left: 5px solid #fa584d !important; }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); }
    .font-weight-bold { font-weight: 700 !important; }
</style>
@endsection
