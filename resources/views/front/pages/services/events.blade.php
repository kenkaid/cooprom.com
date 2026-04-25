@extends('front.layouts.app')

@section('title', 'Événementiel - COOPROM | Festivals & Spectacles Mondiaux')

@section('content')
    <!-- Creative Page Title -->
    <section class="creative-hero-section position-relative d-flex align-items-center justify-content-center text-center text-white overflow-hidden" style="height: 60vh; min-height: 400px;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(45deg, rgba(0,0,0,0.8) 0%, rgba(255,60,54,0.4) 100%);"></div>

        <div class="auto-container position-relative z-index-1 animate-up">
            <span class="d-block h5 text-uppercase mb-3 font-weight-bold tracking-widest text-danger">COOPROM SERVICES</span>
            <h1 class="display-3 font-weight-bold mb-4">Événementiel & Spectacles</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Accueil</a></li>
                    <li class="breadcrumb-item active text-danger" aria-current="page">Événementiel</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Service Content -->
    <section class="creative-service-content py-5">
        <div class="auto-container py-5">
            <div class="row align-items-center mb-5 pb-5">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="image-stack position-relative pr-lg-5">
                        <img src="{{ asset('assets/front/images/resource/service-4.jpg') }}" alt="Événementiel" class="img-fluid rounded-lg shadow-2xl relative z-index-2">
                        <div class="stack-box position-absolute bg-danger rounded-lg z-index-1" style="bottom: -30px; right: 20px; width: 80%; height: 80%; opacity: 0.1;"></div>
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="pl-lg-4">
                        <div class="sec-title-creative mb-4">
                            <h2 class="display-5 font-weight-bold mb-3">L'Art de l'Organisation</h2>
                            <div class="title-line w-25 bg-danger" style="height: 4px;"></div>
                        </div>
                        <p class="lead text-dark mb-4">La COOPROM est un carrefour pour l’organisation de spectacles et d’événements culturels en Côte d’Ivoire et dans le monde entier.</p>
                        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                            Qu’il s’agisse de séminaires, de foires, de festivals ou d’expositions, notre équipe dynamique met tout en œuvre pour assurer le succès logistique et médiatique de chaque projet. Nous orchestrons des moments uniques pour célébrer le talent de nos adhérents.
                        </p>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('events.index') }}" class="theme-btn btn-style-one mr-4">
                                <span class="btn-title">Découvrir l'Agenda <i class="fas fa-arrow-right ml-2"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Creative Feature Grid -->
            <div class="row g-4 mt-5">
                <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: 0.1s;">
                    <div class="creative-card h-100 p-5 bg-white shadow-lg rounded-xl border-top-5 border-danger text-center">
                        <div class="icon-circle bg-light-danger text-danger mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                            <i class="fas fa-music fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Festivals</h4>
                        <p class="text-muted">Organisation complète de festivals musicaux et artistiques nationaux et internationaux.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: 0.2s;">
                    <div class="creative-card h-100 p-5 bg-white shadow-lg rounded-xl border-top-5 border-danger text-center active-card">
                        <div class="icon-circle bg-danger text-white mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                            <i class="fas fa-palette fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Expositions</h4>
                        <p class="text-muted">Mise en lumière des œuvres de nos artistes adhérents à travers des vernissages et salons.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: 0.3s;">
                    <div class="creative-card h-100 p-5 bg-white shadow-lg rounded-xl border-top-5 border-danger text-center">
                        <div class="icon-circle bg-light-danger text-danger mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Séminaires</h4>
                        <p class="text-muted">Forums thématiques et congrès sur les enjeux de la culture et du droit d'auteur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Parallax Promotion Section -->
    <section class="parallax-promotion-section py-5 text-white position-relative overflow-hidden" style="background: #1a1a1a;">
        <div class="auto-container py-5 position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h2 class="display-4 font-weight-bold mb-4">Valorisation Folklorique</h2>
                    <p class="lead mb-5 opacity-75">Une de nos missions prioritaires est la promotion des danses traditionnelles africaines et du terroir ivoirien.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white bg-opacity-10 rounded border border-white border-opacity-10">
                                <i class="fas fa-check-circle text-danger mr-3 fa-lg"></i>
                                <span>Forums Culturels</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 bg-white bg-opacity-10 rounded border border-white border-opacity-10">
                                <i class="fas fa-check-circle text-danger mr-3 fa-lg"></i>
                                <span>Tournées Mondiales</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="promo-box p-5 border-2 border-dashed border-danger rounded-lg scale-hover transition-all">
                        <h3 class="mb-4">Votre Événement avec nous ?</h3>
                        <p class="mb-4">Confiez-nous la logistique de votre projet artistique.</p>
                        <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                            <span class="btn-title">Contactez-nous</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Menu (Bottom Sticky Placeholder Idea) -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <span class="mr-4 font-weight-bold text-uppercase d-none d-md-block">Nos Services :</span>
                <a href="{{ route('services.promotion') }}" class="btn btn-link text-muted px-3">Promotion</a>
                <a href="{{ route('services.production') }}" class="btn btn-link text-muted px-3">Production</a>
                <a href="{{ route('services.travels') }}" class="btn btn-link text-muted px-3">Voyages</a>
                <a href="{{ route('services.events') }}" class="btn btn-link text-danger font-weight-bold px-3">Événementiel</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.2em; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
    .rounded-xl { border-radius: 20px !important; }
    .border-top-5 { border-top: 5px solid !important; }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.05); }
    .bg-opacity-10 { background-color: rgba(255, 255, 255, 0.1); }
    .border-opacity-10 { border-color: rgba(255, 255, 255, 0.1) !important; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .creative-card { transition: all 0.4s ease; border-bottom: 1px solid #eee; }
    .creative-card:hover { transform: translateY(-15px); box-shadow: 0 30px 60px -15px rgba(0,0,0,0.15) !important; }
    .active-card { transform: scale(1.05); z-index: 5; border-color: #ff3c36 !important; }

    .scale-hover:hover { transform: scale(1.03); }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
