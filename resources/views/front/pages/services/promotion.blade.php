@extends('front.layouts.app')

@section('title', 'Promotion Artistique - COOPROM | Valorisation & Diffusion')

@section('content')
    <!-- dynamic background hero -->
    <section class="promotion-hero position-relative overflow-hidden d-flex align-items-center" style="min-height: 80vh; background: #0a0a0a;">
        <div class="hero-shapes position-absolute w-100 h-100">
            <div class="shape-1 position-absolute bg-danger opacity-25 rounded-circle" style="width: 400px; height: 400px; top: -100px; right: -100px; filter: blur(100px);"></div>
            <div class="shape-2 position-absolute bg-primary opacity-10 rounded-circle" style="width: 300px; height: 300px; bottom: -50px; left: -50px; filter: blur(80px);"></div>
        </div>

        <div class="auto-container position-relative z-index-1 text-white">
            <div class="row align-items-center">
                <div class="col-lg-7 animate-left">
                    <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Expansion Artistique</h5>
                    <h1 class="display-3 font-weight-bold mb-4">Promouvoir <span class="text-transparent-outline">votre Art</span> au-delà des frontières</h1>
                    <p class="lead mb-5 opacity-75">La COOPROM réinvente la diffusion artistique. Nous créons des ponts stratégiques entre votre créativité et les marchés internationaux.</p>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('contact') }}" class="theme-btn btn-style-one mr-4">
                            <span class="btn-title">Propulser mon art</span>
                        </a>
                        <div class="play-btn-box d-flex align-items-center">
                            <span class="small font-weight-bold text-uppercase opacity-50">Expertise Mondiale</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block animate-right">
                    <div class="creative-image-box position-relative p-4">
                        <div class="border-box position-absolute w-100 h-100 border-2 border-danger rounded-2xl" style="top: 0; left: 0; transform: rotate(3deg); z-index: -1;"></div>
                        <img src="{{ asset('assets/front/images/resource/service-1.jpg') }}" alt="Promotion" class="img-fluid rounded-2xl shadow-2xl relative z-index-2">
                        <div class="floating-badge position-absolute bg-white text-dark p-3 rounded shadow-lg animate-bounce" style="top: 20%; right: -30px;">
                            <i class="fas fa-chart-line text-danger mr-2"></i> <span class="font-weight-bold">+100% Visibilité</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="sec-title mb-4">
                            <h2 class="font-weight-bold display-5">Notre <span class="text-danger">Expertise</span></h2>
                        </div>
                        <p class="text-muted mb-4">Nous améliorons les techniques de promotion des artistes de toutes tendances confondues par des stratégies innovantes.</p>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-2"></i> Distribution Mondiale</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-2"></i> Gestion Commerciale</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-2"></i> Import / Export d'œuvres</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-6 mb-4 animate-up">
                            <div class="feature-card-modern p-5 h-100 transition-all border border-light rounded-2xl hover-shadow">
                                <div class="icon-box-modern mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 15px;">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Achat & Vente</h4>
                                <p class="text-muted small">Nous gérons l'aspect commercial de vos œuvres artistiques pour vous permettre de vous concentrer sur la création.</p>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-6 mb-4 animate-up" style="animation-delay: 0.2s;">
                            <div class="feature-card-modern p-5 h-100 transition-all border border-light rounded-2xl hover-shadow">
                                <div class="icon-box-modern mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 15px;">
                                    <i class="fas fa-truck-loading fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Logistique Export</h4>
                                <p class="text-muted small">Facilitation de l'exportation de vos créations vers les galeries, foires et festivals mondiaux de renom.</p>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-md-6 mb-4 animate-up" style="animation-delay: 0.3s;">
                            <div class="feature-card-modern p-5 h-100 transition-all border border-light rounded-2xl hover-shadow">
                                <div class="icon-box-modern mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 15px;">
                                    <i class="fas fa-bullhorn fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Diffusion Stratégique</h4>
                                <p class="text-muted small">Mise en place de campagnes de communication ciblées pour accroître votre notoriété auprès du public cible.</p>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="col-md-6 mb-4 animate-up" style="animation-delay: 0.4s;">
                            <div class="feature-card-modern p-5 h-100 transition-all border border-light rounded-2xl hover-shadow">
                                <div class="icon-box-modern mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 15px;">
                                    <i class="fas fa-handshake fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Réseautage</h4>
                                <p class="text-muted small">Accès privilégié à un réseau mondial de promoteurs, collectionneurs et agents culturels.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('services.promotion') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Promotion</a>
                <a href="{{ route('services.production') }}" class="btn btn-link text-muted px-3">Production</a>
                <a href="{{ route('services.travels') }}" class="btn btn-link text-muted px-3">Voyages</a>
                <a href="{{ route('services.events') }}" class="btn btn-link text-muted px-3">Événementiel</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.2em; }
    .rounded-2xl { border-radius: 30px !important; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(255, 60, 54, 0.2); }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.1); }

    .text-transparent-outline {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .animate-left { opacity: 0; animation: fadeInLeft 1.2s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1.2s forwards; }
    .animate-up { opacity: 0; animation: fadeInUp 0.8s forwards; }
    .animate-bounce { animation: bounce 4s infinite; }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-60px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(60px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .feature-card-modern { background: #fff; }
    .feature-card-modern:hover { transform: scale(1.05); border-color: #ff3c36 !important; background: #fff; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
    .hover-shadow:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
