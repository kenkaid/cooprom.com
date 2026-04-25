@extends('front.layouts.app')

@section('title', 'Voyages d\'Affaires - COOPROM | Networking International')

@section('content')
    <!-- Premium Hero Section -->
    <section class="premium-hero position-relative d-flex align-items-center justify-content-center text-white py-5" style="min-height: 60vh;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 100%);"></div>

        <div class="auto-container position-relative z-index-1 py-4">
            <div class="row">
                <div class="col-lg-8 animate-left">
                    <span class="badge bg-danger px-3 py-2 mb-4 text-uppercase tracking-widest shadow-lg">Mobilité & International</span>
                    <h1 class="display-3 font-weight-bold mb-4 line-height-1">Voyages d'Affaires <br>& Networking</h1>
                    <p class="lead mb-4 text-white max-width-600" style="opacity: 0.95; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">Connectez votre talent aux marchés mondiaux. La COOPROM ouvre les portes de l'expertise étrangère pour nos adhérents.</p>
                    <div class="hero-btns mt-2">
                        <a href="{{ route('member.travels.index') }}" class="theme-btn btn-style-one mr-3 shadow-lg">
                            <span class="btn-title">Mes Demandes <i class="fas fa-passport ml-2"></i></span>
                        </a>
                        <a href="#details" class="btn btn-outline-white btn-lg rounded-pill px-4 shadow-sm">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Plane SVG Decoration -->
        <div class="position-absolute d-none d-lg-block" style="bottom: 10%; right: 5%; opacity: 0.2; transform: rotate(-15deg);">
            <i class="fas fa-plane-departure fa-10x"></i>
        </div>
    </section>

    <!-- Info Section with Floating Icons -->
    <section id="details" class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="experience-box position-relative p-5 bg-light rounded-2xl shadow-xl">
                        <div class="sec-title mb-4">
                            <h2 class="font-weight-bold">Échanges Culturels de <span class="text-danger">Haut Niveau</span></h2>
                        </div>
                        <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                            Nous programmons durant toute l’année des voyages de groupe consistant à mettre en relation les artistes, professionnels et chefs d’entreprises culturelles avec leurs homologues du monde entier.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-4 d-flex align-items-start">
                                <div class="icon-circle bg-danger text-white mr-3 mt-1"><i class="fas fa-check"></i></div>
                                <div>
                                    <h6 class="font-weight-bold mb-1">Expertise Étrangère</h6>
                                    <small class="text-muted">Améliorez la qualité de vos œuvres grâce aux échanges techniques.</small>
                                </div>
                            </li>
                            <li class="mb-4 d-flex align-items-start">
                                <div class="icon-circle bg-danger text-white mr-3 mt-1"><i class="fas fa-check"></i></div>
                                <div>
                                    <h6 class="font-weight-bold mb-1">Prospection Commerciale</h6>
                                    <small class="text-muted">Trouvez de nouveaux débouchés pour vos créations à l'international.</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="image-box pl-lg-5 position-relative">
                        <img src="{{ asset('assets/front/images/resource/service-3.jpg') }}" alt="Voyages" class="img-fluid rounded-2xl shadow-2xl">
                        <!-- Floating Stats Card -->
                        <div class="position-absolute bg-white p-4 rounded-xl shadow-lg animate-bounce" style="bottom: -20px; left: 0; min-width: 200px;">
                            <div class="d-flex align-items-center">
                                <div class="text-danger h3 mb-0 mr-3"><i class="fas fa-globe-africa"></i></div>
                                <div>
                                    <span class="d-block font-weight-bold">Mobilité</span>
                                    <small class="text-muted">Accès illimité</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Service Grid -->
    <section class="py-5 bg-dark text-white">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5">
                <span class="text-danger text-uppercase font-weight-bold">Accompagnement</span>
                <h2 class="text-white font-weight-bold display-5">Comment nous vous aidons ?</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box-creative p-4 h-100 transition-all border border-white border-opacity-10 rounded-xl hover-bg-danger">
                        <div class="icon mb-4"><i class="fas fa-passport fa-3x text-danger"></i></div>
                        <h4 class="font-weight-bold mb-3">Assistance Visa</h4>
                        <p class="opacity-75">Orientation complète sur les documents exigés pour vos missions à l'étranger (Schengen, USA, Afrique).</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box-creative p-4 h-100 transition-all border border-white border-opacity-10 rounded-xl hover-bg-danger">
                        <div class="icon mb-4"><i class="fas fa-users-cog fa-3x text-danger"></i></div>
                        <h4 class="font-weight-bold mb-3">Mise en relation B2B</h4>
                        <p class="opacity-75">Mise en relation directe avec des promoteurs et agents culturels internationaux.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box-creative p-4 h-100 transition-all border border-white border-opacity-10 rounded-xl hover-bg-danger">
                        <div class="icon mb-4"><i class="fas fa-graduation-cap fa-3x text-danger"></i></div>
                        <h4 class="font-weight-bold mb-3">Inscriptions Festivals</h4>
                        <p class="opacity-75">Gestion de vos inscriptions aux grands forums et festivals internationaux de renom.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sticky Navigation Menu -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('services.promotion') }}" class="btn btn-link text-muted px-3">Promotion</a>
                <a href="{{ route('services.production') }}" class="btn btn-link text-muted px-3">Production</a>
                <a href="{{ route('services.travels') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Voyages</a>
                <a href="{{ route('services.events') }}" class="btn btn-link text-muted px-3">Événementiel</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .tracking-widest { letter-spacing: 0.2em; }
    .line-height-1 { line-height: 1.1; }
    .max-width-600 { max-width: 600px; }
    .rounded-2xl { border-radius: 30px !important; }
    .rounded-xl { border-radius: 20px !important; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); }
    .bg-opacity-10 { background-color: rgba(255, 255, 255, 0.05); }

    .icon-circle { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; }

    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }
    .animate-bounce { animation: bounce 3s infinite; }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-50px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .service-box-creative { transition: all 0.4s ease; background: rgba(255,255,255,0.03); }
    .service-box-creative:hover { background: #ff3c36; transform: translateY(-10px); border-color: transparent !important; }
    .service-box-creative:hover p, .service-box-creative:hover .icon i { color: white !important; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
    .btn-outline-white { border: 2px solid white; color: white; transition: 0.3s; }
    .btn-outline-white:hover { background: white; color: #ff3c36; }
</style>
@endsection
