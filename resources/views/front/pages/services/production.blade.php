@extends('front.layouts.app')

@section('title', 'Production Numérique - COOPROM | Technologie Temps Réel')

@section('content')
    <!-- Tech/Futuristic Hero -->
    <section class="tech-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 80vh; background: #000;">
        <div class="video-overlay position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed; opacity: 0.4;"></div>
        <div class="glitch-overlay position-absolute w-100 h-100" style="background: linear-gradient(0deg, rgba(255,60,54,0.4) 0%, transparent 100%);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest"><i class="fas fa-microchip mr-2"></i> Future-Ready Art</h5>
            <h1 class="display-2 font-weight-bold mb-4">Production <span class="text-gradient">Numérique</span></h1>
            <p class="lead mb-5 max-width-700 mx-auto text-white" style="opacity: 0.95;">Plongez dans l'ère du Temps Réel. La COOPROM propulse votre créativité grâce aux dernières innovations technologiques.</p>
            <div class="scroll-indicator animate-bounce">
                <i class="fas fa-chevron-down fa-2x text-danger"></i>
            </div>
        </div>
    </section>

    <!-- Innovation Section -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 animate-left">
                    <div class="image-wrapper position-relative">
                        <div class="tech-border position-absolute w-100 h-100 border-2 border-danger rounded-2xl" style="top: -20px; left: -20px; z-index: -1;"></div>
                        <img src="{{ asset('assets/front/images/resource/service-2.jpg') }}" alt="Innovation" class="img-fluid rounded-2xl shadow-2xl">
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 animate-right">
                    <div class="pl-lg-5">
                        <h2 class="display-5 font-weight-bold mb-4">L'Innovation au service de l'Art</h2>
                        <p class="lead text-danger font-weight-bold mb-4">Technologies "Temps Réel" & Immersives</p>
                        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                            La COOPROM offre aux artistes un accès privilégié à une plateforme de production axée sur les pratiques modernes. Notre objectif est d'accompagner l'artiste ivoirien dans sa transition vers le numérique, en lui offrant les outils nécessaires pour créer des œuvres impactantes.
                        </p>

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded-xl border-left-5 border-danger">
                                    <h6 class="font-weight-bold mb-0">Cinéma & Clips</h6>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded-xl border-left-5 border-danger">
                                    <h6 class="font-weight-bold mb-0">Galeries Virtuelles</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Grid -->
    <section class="py-5 bg-light">
        <div class="auto-container py-5">
            <div class="sec-title-creative text-center mb-5">
                <h2 class="font-weight-bold">Notre Écosystème Digital</h2>
                <div class="divider mx-auto bg-danger" style="width: 50px; height: 3px;"></div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 animate-up">
                    <div class="tech-card p-5 bg-white rounded-2xl shadow-sm hover-shadow-xl transition-all h-100">
                        <div class="icon-box text-white bg-danger mb-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 15px;">
                            <i class="fas fa-vr-cardboard fa-lg"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Immersif</h4>
                        <p class="text-muted small">Création d'espaces virtuels et d'expositions 3D accessibles depuis n'importe quel point du globe.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: 0.2s;">
                    <div class="tech-card p-5 bg-white rounded-2xl shadow-sm hover-shadow-xl transition-all h-100">
                        <div class="icon-box text-white bg-dark mb-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 15px;">
                            <i class="fas fa-bolt fa-lg text-danger"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Temps Réel</h4>
                        <p class="text-muted small">Support technique pour les performances live utilisant des technologies de pointe (Mocap, VFX).</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: 0.3s;">
                    <div class="tech-card p-5 bg-white rounded-2xl shadow-sm hover-shadow-xl transition-all h-100">
                        <div class="icon-box text-white bg-danger mb-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 15px;">
                            <i class="fas fa-chalkboard-teacher fa-lg"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Formation</h4>
                        <p class="text-muted small">Programmes d'apprentissage sur les outils numériques de production pour tous nos adhérents.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('services.promotion') }}" class="btn btn-link text-muted px-3">Promotion</a>
                <a href="{{ route('services.production') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Production</a>
                <a href="{{ route('services.travels') }}" class="btn btn-link text-muted px-3">Voyages</a>
                <a href="{{ route('services.events') }}" class="btn btn-link text-muted px-3">Événementiel</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .tracking-widest { letter-spacing: 0.3em; }
    .max-width-700 { max-width: 700px; }
    .rounded-2xl { border-radius: 25px !important; }
    .border-left-5 { border-left: 5px solid !important; }

    .text-gradient {
        background: linear-gradient(45deg, #ff3c36, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }
    .animate-bounce { animation: bounce 2s infinite; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-30px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

    .tech-card:hover { transform: translateY(-10px); border-color: #ff3c36 !important; }
    .hover-shadow-xl:hover { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
