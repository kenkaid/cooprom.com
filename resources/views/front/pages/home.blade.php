@extends('front.layouts.app')

@section('title', 'COOPROM | L\'Élite de la Promotion Artistique Africaine')

@section('content')
    <!-- SUPER CREATIVE HERO SECTION -->
    <section class="creative-home-hero position-relative overflow-hidden d-flex align-items-center" style="min-height: 100vh; background: #000;">
        <div class="hero-video-bg position-absolute w-100 h-100">
            <!-- Background Image with Overlay -->
            <div class="bg-img position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/main-slider/slide1.jpg') }}) center/cover fixed; opacity: 0.4; filter: contrast(1.2);"></div>
            <div class="overlay position-absolute w-100 h-100" style="background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>
        </div>

        <div class="auto-container position-relative z-index-2">
            <div class="hero-content-box">
                <div class="animate-left">
                    <span class="d-inline-block px-3 py-1 bg-danger text-white text-uppercase font-weight-bold tracking-widest mb-4 rounded-pill small">#1 Promotion Artistique</span>
                    <h1 class="display-1 text-white font-weight-bold mb-4 line-height-1">
                        L'ART <br> <span class="text-transparent-stroke-white">SANS LIMITES</span>
                    </h1>
                </div>

                <div class="row align-items-center mt-5">
                    <div class="col-lg-6 animate-up" style="animation-delay: 0.3s;">
                        <p class="lead text-white mb-5 max-width-500" style="opacity: 0.9;">
                            La COOPROM propulse le génie artistique africain sur la scène mondiale. Production, Mobilité, Sécurité : Nous bâtissons le futur de votre talent.
                        </p>
                        <div class="hero-actions d-flex align-items-center">
                            @if (!Auth::user())
                                <a href="{{route('register')}}" class="theme-btn btn-style-one mr-3 py-2 px-4 shadow-sm" style="font-size: 14px;"><span class="btn-title">Devenir Adhérent</span></a>
                            @endif
                            <a href="{{ route('events.index') }}" class="btn btn-danger py-2 px-4 rounded-pill shadow-sm font-weight-bold text-nowrap" style="font-size: 14px;">
                                <i class="fas fa-calendar-alt mr-2"></i> L'Agenda Culturel
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <!-- Floating Elements Decoration -->
                        <div class="hero-floating-elements position-relative">
                            <div class="float-card card-1 bg-white p-3 rounded-xl shadow-lg position-absolute animate-bounce" style="top: -150px; right: 10%; width: 200px;">
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; flex-shrink: 0;"><i class="fas fa-globe fa-sm"></i></div>
                                    <div><small class="text-muted d-block" style="font-size: 10px;">Impact</small><span class="font-weight-bold" style="font-size: 13px;">Mondial</span></div>
                                </div>
                            </div>
                            <div class="float-card card-2 bg-dark text-white p-3 rounded-xl shadow-lg position-absolute animate-float" style="bottom: -100px; right: 30%; width: 180px;">
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-primary text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; flex-shrink: 0;"><i class="fas fa-bolt fa-sm"></i></div>
                                    <div><small class="opacity-50 d-block" style="font-size: 10px;">Vitesse</small><span class="font-weight-bold text-danger" style="font-size: 13px;">Temps Réel</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrolling Ticker -->
        <div class="ticker-box position-absolute w-100 bg-danger py-3" style="bottom: 0; left: 0; transform: rotate(-2deg); width: 110% !important; left: -5%;">
            <div class="ticker-content d-flex white-space-nowrap text-white font-weight-bold text-uppercase">
                <span class="px-5">Promotion Artistique • Production Numérique • Voyages d'Affaires • Assistance Visa • Conseil Juridique • Aide Sociale • </span>
                <span class="px-5">Promotion Artistique • Production Numérique • Voyages d'Affaires • Assistance Visa • Conseil Juridique • Aide Sociale • </span>
            </div>
        </div>
    </section>

    <!-- BENTO GRID SERVICES -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="sec-title-creative mb-5 pb-5">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <h5 class="text-danger font-weight-bold text-uppercase mb-2">Nos Piliers</h5>
                        <h2 class="display-4 font-weight-bold">Expertise <span class="text-transparent-stroke-danger">360°</span></h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-dark lead font-weight-bold">Un écosystème complet conçu pour l'épanouissement total de l'artiste moderne.</p>
                    </div>
                </div>
            </div>

            <div class="bento-grid">
                <div class="row g-4">
                    <!-- Big Card: Promotion -->
                    <div class="col-lg-7 mb-4 animate-left">
                        <div class="bento-card bg-light p-5 h-100 rounded-3xl overflow-hidden position-relative group hover-bg-red transition-all">
                            <div class="position-relative z-index-2">
                                <h3 class="display-6 font-weight-bold mb-3 group-hover-white">Promotion <br>Artistique</h3>
                                <p class="text-muted group-hover-white-50">Diffusion mondiale et stratégies de vente innovantes pour vos œuvres.</p>
                                <a href="{{ route('services.promotion') }}" class="btn btn-danger rounded-pill mt-4">En savoir plus</a>
                            </div>
                            <i class="fas fa-bullhorn position-absolute display-1 opacity-05 group-hover-opacity-10 text-danger" style="bottom: 30px; right: 30px; font-size: 15rem;"></i>
                        </div>
                    </div>
                    <!-- Small Card: Production -->
                    <div class="col-lg-5 mb-4 animate-right">
                        <div class="bento-card bg-dark text-white p-5 h-100 rounded-3xl overflow-hidden position-relative group">
                            <h3 class="h2 font-weight-bold mb-3">Production <br>Numérique</h3>
                            <p class="text-white" style="opacity: 0.8;">L'ère du Temps Réel au service de vos clips et films.</p>
                            <a href="{{ route('services.production') }}" class="btn btn-outline-danger btn-sm rounded-pill mt-3">Découvrir</a>
                            <i class="fas fa-video position-absolute" style="bottom: -20px; right: -20px; font-size: 10rem; opacity: 0.1;"></i>
                        </div>
                    </div>
                    <!-- Small Card: Voyages -->
                    <div class="col-lg-4 mb-4 animate-up">
                        <div class="bento-card bg-danger text-white p-5 h-100 rounded-3xl overflow-hidden position-relative group">
                            <h3 class="h3 font-weight-bold mb-2">Voyages & <br>Mobilité</h3>
                            <p class="small opacity-80">Networking international et assistance visa.</p>
                            <a href="{{ route('services.travels') }}" class="text-white font-weight-bold mt-4 d-block">Partir maintenant <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                    </div>
                    <!-- Medium Card: Assistance -->
                    <div class="col-lg-8 mb-4 animate-up" style="animation-delay: 0.2s;">
                        <div class="bento-card bg-light p-5 h-100 rounded-3xl border-2 border-dashed border-danger d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="h2 font-weight-bold mb-3">Assistance & Sécurité</h3>
                                <p class="text-muted">Juridique, Social et Visa : votre bouclier professionnel.</p>
                            </div>
                            <div class="icons-group d-none d-md-flex">
                                <i class="fas fa-gavel fa-3x text-danger mx-3"></i>
                                <i class="fas fa-heartbeat fa-3x text-danger mx-3"></i>
                                <i class="fas fa-passport fa-3x text-danger mx-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIVE AGENDA SECTION -->
    <section class="py-5 bg-dark text-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="display-5 font-weight-bold mb-0 text-white">Agenda <span class="text-danger">Live</span></h2>
                    <p class="text-white" style="opacity: 0.8;">Ne manquez aucun rendez-vous culturel majeur.</p>
                </div>
                <a href="{{ route('events.index') }}" class="btn btn-outline-danger rounded-pill">Tout l'agenda</a>
            </div>

            <div class="row g-4">
                @forelse($upcomingEvents as $event)
                    <div class="col-lg-4 col-md-6 mb-4 animate-up">
                        <div class="event-card-modern bg-white text-dark rounded-2xl overflow-hidden shadow-2xl h-100 transition-all hover-translate-y">
                            <div class="img-box position-relative">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary w-100" style="height: 250px;"></div>
                                @endif
                                <div class="date-badge position-absolute bg-danger text-white p-2 rounded text-center" style="top: 15px; left: 15px; min-width: 60px;">
                                    <span class="d-block h4 font-weight-bold mb-0">{{ $event->start_date->format('d') }}</span>
                                    <span class="small text-uppercase">{{ $event->start_date->translatedFormat('M') }}</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <span class="badge bg-light-danger text-danger mb-2">{{ ucfirst($event->type) }}</span>
                                <h4 class="font-weight-bold mb-3">{{ Str::limit($event->title, 40) }}</h4>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="small text-muted"><i class="fas fa-map-marker-alt mr-1"></i> {{ Str::limit($event->location, 20) }}</span>
                                    <a href="{{ route('events.show', $event->slug) }}" class="btn btn-danger btn-sm rounded-circle"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center opacity-50 py-5">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p>Aucun événement programmé pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- IMPACT SECTION -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5 text-center">
            <div class="impact-title mb-5">
                <h2 class="display-3 font-weight-bold">COOPROM <span class="text-danger">IMPACT</span></h2>
                <div class="divider mx-auto bg-dark mt-3" style="width: 100px; height: 3px;"></div>
            </div>

            <div class="row g-5">
                <div class="col-lg-3 col-6 mb-4 animate-up">
                    <h2 class="display-4 font-weight-bold text-danger">+5000</h2>
                    <p class="text-uppercase small font-weight-bold">Adhérents</p>
                </div>
                <div class="col-lg-3 col-6 mb-4 animate-up" style="animation-delay: 0.1s;">
                    <h2 class="display-4 font-weight-bold text-dark">20</h2>
                    <p class="text-uppercase small font-weight-bold">Ans d'Expertise</p>
                </div>
                <div class="col-lg-3 col-6 mb-4 animate-up" style="animation-delay: 0.2s;">
                    <h2 class="display-4 font-weight-bold text-danger">50</h2>
                    <p class="text-uppercase small font-weight-bold">Partenaires</p>
                </div>
                <div class="col-lg-3 col-6 mb-4 animate-up" style="animation-delay: 0.3s;">
                    <h2 class="display-4 font-weight-bold text-dark">Global</h2>
                    <p class="text-uppercase small font-weight-bold">Rayonnement</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM PREVIEW -->
    <section class="py-5 bg-light">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5">
                <h2 class="font-weight-bold">L'Équipe de <span class="text-danger">l'Ombre</span></h2>
                <p class="text-muted">Les experts qui propulsent votre carrière.</p>
            </div>
            <div class="row justify-content-center">
                @foreach ($staffUsers as $user)
                    <div class="col-lg-3 col-md-6 mb-4 animate-up">
                        <div class="team-card-minimal text-center group">
                            <div class="img-wrapper mb-3 position-relative overflow-hidden rounded-circle mx-auto" style="width: 200px; height: 200px;">
                                <img src="{{ $user->photo }}" alt="" class="img-fluid grayscale-100 group-hover-color transition-all">
                            </div>
                            <h5 class="font-weight-bold mb-1">{{$user->name}} {{$user->last_name}}</h5>
                            <span class="small text-danger text-uppercase font-weight-bold">{{$user->designation ?? 'Expert'}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="py-5 bg-danger text-white text-center position-relative overflow-hidden">
        <div class="auto-container py-5 position-relative z-index-2">
            <h2 class="display-4 font-weight-bold mb-4">Votre voyage artistique commence ici.</h2>
            <p class="lead mb-5 opacity-80">Rejoignez l'élite des créateurs ivoiriens.</p>
            <a href="{{route('register')}}" class="btn btn-white btn-lg rounded-pill px-5 shadow-2xl text-danger font-weight-bold">S'INSCRIRE MAINTENANT</a>
        </div>
        <div class="position-absolute display-1 opacity-05 font-weight-bold" style="bottom: -20px; left: 0; font-size: 15rem;">COOPROM</div>
    </section>

@endsection

@section('extra_css')
<style>
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.5em; }
    .line-height-1 { line-height: 1.1; }
    .max-width-500 { max-width: 500px; }
    .max-width-600 { max-width: 600px; }
    .max-width-700 { max-width: 700px; }
    .rounded-3xl { border-radius: 50px !important; }
    .rounded-2xl { border-radius: 30px !important; }
    .rounded-xl { border-radius: 20px !important; }
    .opacity-05 { opacity: 0.05; }
    .opacity-10 { opacity: 0.1; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3); }

    .text-transparent-stroke-white { -webkit-text-stroke: 1px white; color: transparent; }
    .text-transparent-stroke-danger { -webkit-text-stroke: 1px #ff3c36; color: transparent; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }
    .animate-bounce { animation: bounce 3s infinite; }
    .animate-float { animation: float 6s infinite ease-in-out; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
    @keyframes float { 0% { transform: translate(0, 0); } 50% { transform: translate(15px, -15px); } 100% { transform: translate(0, 0); } }

    .ticker-box { overflow: hidden; width: 100%; }
    .ticker-content { animation: ticker 40s linear infinite; width: max-content; }
    @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    .bento-card { transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); cursor: pointer; }
    .hover-bg-red:hover { background: #ff3c36 !important; }
    .group:hover .group-hover-white { color: white !important; }
    .group:hover .group-hover-white-50 { color: rgba(255,255,255,0.5) !important; }
    .group:hover .group-hover-opacity-10 { opacity: 0.1 !important; color: white !important; }

    .hover-translate-y:hover { transform: translateY(-15px); }
    .grayscale-100 { filter: grayscale(100%); }
    .group-hover-color:hover { filter: grayscale(0%); transform: scale(1.1); }

    .btn-white { background: white; color: #ff3c36 !important; }
    .btn-white:hover { background: #f8f8f8; }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.05); }
</style>
@endsection
