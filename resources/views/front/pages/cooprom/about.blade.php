@extends('front.layouts.app')

@section('title', 'À Propos - COOPROM | Notre Vision & Engagement')

@section('content')
    <!-- Institution Hero (Custom Artistic Background) -->
    <section class="institution-hero position-relative d-flex align-items-center overflow-hidden" style="min-height: 70vh; background: #0a0a0a;">
        <!-- Artistic & Geometric Background Layer -->
        <div class="artistic-bg-layer position-absolute w-100 h-100">
            <!-- Geometric Grid Pattern -->
            <div class="geometric-grid position-absolute w-100 h-100 opacity-10" style="background-image: radial-gradient(#ff3c36 1px, transparent 1px); background-size: 30px 30px;"></div>

            <!-- Abstract Artistic Shapes (SVG) -->
            <div class="art-shape shape-1 position-absolute animate-float" style="top: 15%; right: 10%; opacity: 0.15;">
                <svg width="150" height="150" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 5L10 30V70L50 95L90 70V30L50 5Z" stroke="#ff3c36" stroke-width="2"/>
                    <circle cx="50" cy="50" r="20" stroke="#ff3c36" stroke-width="1"/>
                    <path d="M50 30V70M30 50H70" stroke="#ff3c36" stroke-width="1"/>
                </svg>
            </div>

            <div class="art-shape shape-2 position-absolute animate-float-delayed" style="bottom: 20%; left: 5%; opacity: 0.1;">
                <svg width="200" height="200" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="10" width="80" height="80" rx="40" stroke="white" stroke-width="1" stroke-dasharray="4 4"/>
                    <path d="M30 30L70 70M70 30L30 70" stroke="white" stroke-width="1"/>
                </svg>
            </div>

            <div class="art-shape shape-3 position-absolute animate-float" style="top: 30%; left: 15%; opacity: 0.08;">
                <i class="fas fa-mask fa-8x text-white"></i>
            </div>

            <div class="art-shape shape-4 position-absolute animate-float-delayed" style="bottom: 10%; right: 15%; opacity: 0.12;">
                <i class="fas fa-palette fa-10x text-danger"></i>
            </div>

            <!-- Floating Dots & Lines -->
            <div class="dot-deco position-absolute bg-danger rounded-circle" style="width: 10px; height: 10px; top: 40%; right: 40%; opacity: 0.5;"></div>
            <div class="dot-deco position-absolute bg-white rounded-circle" style="width: 6px; height: 6px; bottom: 30%; left: 40%; opacity: 0.3;"></div>
        </div>

        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent, #0a0a0a);"></div>

        <div class="auto-container position-relative z-index-1 text-white">
            <div class="row align-items-center">
                <div class="col-lg-8 animate-left">
                    <span class="badge bg-danger px-3 py-2 mb-4 text-uppercase tracking-widest font-weight-bold shadow-lg">L'Institution</span>
                    <h1 class="display-2 font-weight-bold mb-4 line-height-1">Nous sommes la <br><span class="text-danger">COOPROM</span></h1>
                    <p class="lead mb-5 text-white" style="opacity: 0.95;">Le partenaire stratégique incontournable pour l'ascension des artistes et la valorisation du patrimoine culturel africain.</p>
                </div>
            </div>
        </div>

        <!-- Scrolling Text Decoration -->
        <div class="scrolling-text-box position-absolute w-100" style="bottom: 5%; left: 0; white-space: nowrap; opacity: 0.03;">
            <span class="display-1 font-weight-bold text-uppercase text-white">PROMOTION • PRODUCTION • MOBILITÉ • EXCELLENCE • CULTURE • </span>
        </div>
    </section>

    <!-- History Section with Creative Layout -->
    <section class="history-section py-5 bg-white">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="creative-image-stack position-relative p-4">
                        <div class="border-accent position-absolute border-2 border-danger rounded-2xl" style="top:0; left:0; width:90%; height:90%; transform: rotate(-4deg); z-index: 1;"></div>
                        <img src="{{ asset('assets/front/images/resource/prez.jpg') }}" alt="COOPROM" class="img-fluid rounded-2xl shadow-2xl position-relative z-index-2 transform-hover-rotate">

                        <div class="experience-badge-creative position-absolute bg-danger text-white p-4 rounded-xl shadow-xl animate-up" style="bottom: -20px; right: -20px; z-index: 3;">
                            <h2 class="mb-0 font-weight-bold display-4">20</h2>
                            <p class="text-uppercase small font-weight-bold mb-0">Ans de succès</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="pl-lg-5">
                        <div class="sec-title-modern mb-5">
                            <h5 class="text-danger font-weight-bold mb-2">NOTRE HISTOIRE</h5>
                            <h2 class="display-5 font-weight-bold">Au service de l'Art depuis <span class="text-transparent-stroke">2005</span></h2>
                            <div class="title-line w-25 bg-danger mt-3" style="height: 4px;"></div>
                        </div>
                        <div class="content-text text-dark" style="font-size: 1.15rem; line-height: 1.9;">
                            <p class="mb-4">Régie par la loi n° 97_721, la <strong>COOPROM</strong> est une institution culturelle d'élite spécialisée dans l’accompagnement de carrière pour toutes les disciplines artistiques.</p>
                            <p class="mb-5 text-muted">Nous ne nous contentons pas d'être une coopérative ; nous sommes un moteur d'innovation, apportant assistance technique, matérielle et stratégique pour que chaque talent ivoirien puisse briller au-delà des frontières.</p>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6 mb-3">
                                <div class="stat-card p-4 border rounded-xl hover-bg-danger transition-all">
                                    <h3 class="font-weight-bold text-danger mb-1">100%</h3>
                                    <p class="small font-weight-bold text-uppercase mb-0">Engagement Adhérent</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="stat-card p-4 border rounded-xl hover-bg-danger transition-all">
                                    <h3 class="font-weight-bold text-danger mb-1">Global</h3>
                                    <p class="small font-weight-bold text-uppercase mb-0">Réseau International</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Missions & Vision (Interlaced Section) -->
    <section class="vision-section py-5 bg-light overflow-hidden">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5 pb-5">
                <span class="text-danger font-weight-bold text-uppercase">Notre ADN</span>
                <h2 class="font-weight-bold display-5">Vision & Missions</h2>
            </div>

            <div class="row align-items-stretch">
                <!-- Mission Card 1 -->
                <div class="col-lg-4 mb-4 animate-up">
                    <div class="vision-card p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-xl transition-all border-bottom-5 border-danger">
                        <div class="icon-box-vision mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 18px;">
                            <i class="fas fa-rocket fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Propulsion</h4>
                        <p class="text-muted">Améliorer les techniques de promotion et de production pour assurer un progrès matériel et artistique durable.</p>
                    </div>
                </div>
                <!-- Mission Card 2 -->
                <div class="col-lg-4 mb-4 animate-up" style="animation-delay: 0.2s;">
                    <div class="vision-card p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-xl transition-all border-bottom-5 border-danger">
                        <div class="icon-box-vision mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 18px;">
                            <i class="fas fa-globe-africa fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Rayonnement</h4>
                        <p class="text-muted">Valoriser la culture ivoirienne et africaine sur tous les continents grâce à nos pôles d'échanges internationaux.</p>
                    </div>
                </div>
                <!-- Mission Card 3 -->
                <div class="col-lg-4 mb-4 animate-up" style="animation-delay: 0.3s;">
                    <div class="vision-card p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-xl transition-all border-bottom-5 border-danger">
                        <div class="icon-box-vision mb-4 bg-light-danger text-danger d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 18px;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Protection</h4>
                        <p class="text-muted">Offrir un cadre juridique et social sécurisant (contrats, visas, assurances) pour l'épanouissement de l'artiste.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('cooprom.missions') }}" class="theme-btn btn-style-one">
                    <span class="btn-title">Détails de nos Missions <i class="fas fa-plus ml-2"></i></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section Preview -->
    <section class="py-5 bg-dark text-white">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="font-weight-bold display-6 mb-3">Un Réseau de <br><span class="text-danger">Partenaires</span> Solide</h2>
                    <p class="text-white mb-4" style="opacity: 0.9;">Nous collaborons avec les meilleures institutions pour garantir l'excellence à nos adhérents.</p>
                    <a href="{{ route('cooprom.partenaires') }}" class="btn btn-outline-white btn-lg rounded-pill px-4">Voir les partenaires</a>
                </div>
                <div class="col-lg-7">
                    <div class="row opacity-25">
                        <div class="col-4 mb-4 text-center"><i class="fas fa-university fa-3x"></i></div>
                        <div class="col-4 mb-4 text-center"><i class="fas fa-landmark fa-3x"></i></div>
                        <div class="col-4 mb-4 text-center"><i class="fas fa-building fa-3x"></i></div>
                        <div class="col-4 mb-4 text-center"><i class="fas fa-handshake fa-3x"></i></div>
                        <div class="col-4 mb-4 text-center"><i class="fas fa-briefcase fa-3x"></i></div>
                        <div class="col-4 mb-4 text-center"><i class="fas fa-broadcast-tower fa-3x"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.3em; }
    .line-height-1 { line-height: 1.1; }
    .max-width-700 { max-width: 700px; }
    .rounded-2xl { border-radius: 30px !important; }
    .rounded-xl { border-radius: 20px !important; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.08); }
    .border-bottom-5 { border-bottom: 5px solid !important; }

    .text-transparent-stroke {
        -webkit-text-stroke: 1px #ff3c36;
        color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }
    .animate-float { animation: float-art 6s infinite ease-in-out; }
    .animate-float-delayed { animation: float-art 8s infinite ease-in-out 2s; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes float-art {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    .transform-hover-rotate:hover { transform: rotate(2deg) scale(1.02); transition: 0.5s; }

    .stat-card:hover { background: #ff3c36; border-color: #ff3c36 !important; }
    .stat-card:hover h3, .stat-card:hover p { color: white !important; }

    .vision-card:hover { transform: translateY(-10px); }
    .hover-shadow-xl:hover { box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1) !important; }

    .btn-outline-white { border: 2px solid white; color: white; transition: 0.3s; }
    .btn-outline-white:hover { background: white; color: #ff3c36; }
</style>
@endsection
