@extends('front.layouts.app')

@section('title', 'Missions & Objectifs - COOPROM | Notre Vision Stratégique')

@section('content')
    <!-- dynamic background hero -->
    <section class="missions-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 60vh; background: #1a1a1a;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed; opacity: 0.4;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: radial-gradient(circle, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <span class="d-block h5 text-danger font-weight-bold text-uppercase mb-3 tracking-widest mobile-small-text">Vision 2030</span>
            <h1 class="display-3 font-weight-bold mb-4 responsive-h1">Missions & <span class="text-transparent-stroke-white">Engagements</span></h1>
            <div class="divider mx-auto bg-danger mb-4" style="width: 80px; height: 5px; border-radius: 10px;"></div>
            <p class="lead max-width-700 mx-auto text-white responsive-p" style="opacity: 0.95;">Bâtir un écosystème où chaque artiste africain possède les outils pour conquérir le monde.</p>
        </div>
    </section>

    <!-- Core Mission (Visual Box) -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5">
            <div class="mission-master-card position-relative p-5 bg-dark text-white rounded-3xl overflow-hidden shadow-2xl animate-up">
                <div class="decoration-circle position-absolute bg-danger opacity-10" style="width: 300px; height: 300px; top: -100px; right: -100px; border-radius: 50%;"></div>

                <div class="row align-items-center position-relative z-index-1">
                    <div class="col-lg-7">
                        <h2 class="display-5 font-weight-bold mb-4">Une Raison d'Être <span class="text-danger">Fondamentale</span></h2>
                        <p class="lead mb-5 text-white" style="opacity: 0.95; line-height: 1.8;">La COOPROM a pour mission d’apporter une valeur ajoutée décisive à l’art et la culture ivoirienne. Nous créons les conditions pour que le terroir ivoirien rayonne hors de ses frontières par l’excellence organisationnelle et la participation mondiale.</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 bg-danger bg-opacity-10 rounded-xl border border-danger border-opacity-20">
                                    <div class="icon-sm bg-danger rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="fas fa-check fa-xs text-white"></i>
                                    </div>
                                    <span class="small font-weight-bold text-white">Valorisation Terroir</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 bg-danger bg-opacity-10 rounded-xl border border-danger border-opacity-20">
                                    <div class="icon-sm bg-danger rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="fas fa-check fa-xs text-white"></i>
                                    </div>
                                    <span class="small font-weight-bold text-white">Accompagnement Technique</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="mission-icon-box text-center">
                            <i class="fas fa-bullseye fa-10x text-danger opacity-20 animate-pulse"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specific Objectives (Interactive Grid) -->
    <section class="py-5 bg-light overflow-hidden">
        <div class="auto-container py-5">
            <div class="sec-title-creative text-center mb-5 pb-5">
                <span class="text-danger font-weight-bold text-uppercase">Actions Concrètes</span>
                <h2 class="font-weight-bold display-5">Nos Objectifs Stratégiques</h2>
            </div>

            <div class="row g-4">
                @php
                    $objectives = [
                        ['icon' => 'fas fa-film', 'title' => 'Production Élite', 'text' => 'Production et promotion artistique et culturelle de haut niveau utilisant les standards internationaux.'],
                        ['icon' => 'fas fa-broadcast-tower', 'title' => 'Omnicanalité', 'text' => 'Assurer une large diffusion des œuvres culturelles sur tous les supports numériques et physiques.'],
                        ['icon' => 'fas fa-briefcase', 'title' => 'Mobilité Globale', 'text' => 'Organisation et assistance pour les voyages d\'affaires culturels à travers le monde.'],
                        ['icon' => 'fas fa-mask', 'title' => 'Patrimoine Vivant', 'text' => 'Promotion et valorisation des danses folkloriques et traditions ancestrales ivoiriennes.'],
                        ['icon' => 'fas fa-handshake', 'title' => 'Diplomatie Culturelle', 'text' => 'Création de pôles de contacts stratégiques dans toutes les ambassades de Côte d’Ivoire.'],
                        ['icon' => 'fas fa-exchange-alt', 'title' => 'Hub d\'Échange', 'text' => 'Plateforme dynamique d’échange et de collaboration entre créateurs de tous horizons.'],
                    ];
                @endphp

                @foreach($objectives as $index => $obj)
                <div class="col-lg-4 col-md-6 mb-5 animate-up" style="animation-delay: {{ 0.1 * $index }}s;">
                    <div class="objective-card-creative p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-2xl transition-all position-relative overflow-hidden group">
                        <div class="group-hover-bg position-absolute w-100 h-100 bg-danger" style="top: 100%; left: 0; transition: 0.5s; z-index: 1; opacity: 0.03;"></div>

                        <div class="icon-box-modern mb-4 text-danger transition-all relative z-index-2">
                            <i class="{{ $obj['icon'] }} fa-3x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3 relative z-index-2">{{ $obj['title'] }}</h4>
                        <p class="text-muted small relative z-index-2">{{ $obj['text'] }}</p>

                        <div class="card-number position-absolute text-light font-weight-bold display-4" style="bottom: -10px; right: 20px; opacity: 0.1; z-index: 1;">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('cooprom.presentation') }}" class="btn btn-link text-muted px-3">Présentation</a>
                <a href="{{ route('cooprom.missions') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Missions</a>
                <a href="{{ route('cooprom.partenaires') }}" class="btn btn-link text-muted px-3">Partenaires</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.4em; }
    .rounded-3xl { border-radius: 40px !important; }
    .rounded-2xl { border-radius: 25px !important; }
    .rounded-xl { border-radius: 15px !important; }
    .bg-opacity-10 { background-color: rgba(255, 255, 255, 0.1); }

    .text-transparent-stroke-white {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-pulse { animation: pulse 2s infinite; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0% { transform: scale(1); opacity: 0.2; } 50% { transform: scale(1.05); opacity: 0.3; } 100% { transform: scale(1); opacity: 0.2; } }

    .objective-card-creative { border-top: 1px solid #f0f0f0; transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .objective-card-creative:hover { transform: translateY(-15px); border-top-color: #ff3c36; }
    .objective-card-creative:hover .group-hover-bg { top: 0; }
    .objective-card-creative:hover .icon-box-modern { transform: scale(1.1); }

    .hover-shadow-2xl:hover { box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.1) !important; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }

    @media (max-width: 767px) {
        .responsive-h1 { font-size: 2.2rem !important; }
        .responsive-p { font-size: 1rem !important; }
        .mobile-small-text { font-size: 0.8rem !important; letter-spacing: 0.2em !important; }
        .missions-hero { height: auto !important; min-height: 350px !important; padding: 60px 0; }
        .display-5 { font-size: 1.8rem !important; }
    }
</style>
@endsection
