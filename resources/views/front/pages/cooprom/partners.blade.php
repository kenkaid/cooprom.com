@extends('front.layouts.app')

@section('title', 'Partenaires - COOPROM | Notre Réseau International')

@section('content')
    <!-- Creative Partners Hero -->
    <section class="partners-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 60vh; background: #000;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed; opacity: 0.4;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(255,60,54,0.6) 0%, rgba(0,0,0,0.9) 100%);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Synergie & Excellence</h5>
            <h1 class="display-3 font-weight-bold mb-4">Notre Réseau de <br><span class="text-transparent-stroke-white">Partenaires</span></h1>
            <p class="lead max-width-700 mx-auto text-white" style="opacity: 0.95;">Parce que l'union fait la force de l'art, nous bâtissons des alliances stratégiques mondiales.</p>
        </div>
    </section>

    <!-- Partners Strategy Section -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 animate-left">
                    <div class="pl-lg-0">
                        <div class="sec-title-modern mb-4">
                            <span class="text-danger font-weight-bold">COLLABORATION STRATÉGIQUE</span>
                            <h2 class="display-5 font-weight-bold">Un levier pour le <span class="text-danger">Progrès</span></h2>
                        </div>
                        <p class="text-dark mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                            La COOPROM développe un réseau de partenaires d'élite en Côte d’Ivoire et à l’étranger pour favoriser les échanges d’expériences, la co-production et la diffusion mondiale des œuvres.
                        </p>
                        <div class="feature-list mt-5">
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-xl transition-all hover-translate-r">
                                <div class="icon-circle bg-danger text-white mr-3"><i class="fas fa-handshake"></i></div>
                                <span class="font-weight-bold">Alliances Institutionnelles</span>
                            </div>
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-xl transition-all hover-translate-r">
                                <div class="icon-circle bg-danger text-white mr-3"><i class="fas fa-money-bill-wave"></i></div>
                                <span class="font-weight-bold">Investisseurs Culturels</span>
                            </div>
                            <div class="d-flex align-items-center p-3 bg-light rounded-xl transition-all hover-translate-r">
                                <div class="icon-circle bg-danger text-white mr-3"><i class="fas fa-globe"></i></div>
                                <span class="font-weight-bold">Réseaux de Diffusion Mondiaux</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 animate-right">
                    <div class="image-box position-relative p-4">
                        <div class="stack-box position-absolute bg-danger opacity-10 rounded-3xl" style="top:0; right:0; width:100%; height:100%; transform: rotate(3deg); z-index: 1;"></div>
                        <img src="{{ asset('assets/front/images/resource/image-1.jpg') }}" alt="Partenaires" class="img-fluid rounded-3xl shadow-2xl position-relative z-index-2">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Grid (Premium Look) -->
    <section class="py-5 bg-light">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5 pb-4">
                <h2 class="font-weight-bold">Ils nous font <span class="text-danger">Confiance</span></h2>
                <div class="divider mx-auto bg-danger mt-3" style="width: 60px; height: 4px;"></div>
            </div>

            <div class="row text-center align-items-center">
                @for ($i = 1; $i <= 6; $i++)
                <div class="col-lg-3 col-md-4 col-6 mb-5 animate-up" style="animation-delay: {{ $i * 0.1 }}s;">
                    <div class="partner-card-premium p-4 bg-white rounded-2xl shadow-sm hover-shadow-xl transition-all group">
                        <img src="{{ asset('assets/front/images/clients/'.$i.'.png') }}" alt="Partenaire" class="img-fluid grayscale-100 group-hover-color transition-all" style="max-height: 80px;">
                    </div>
                </div>
                @endfor

                <div class="col-lg-3 col-md-4 col-6 mb-5 animate-up" style="animation-delay: 0.7s;">
                    <a href="{{ route('contact') }}" class="partner-card-premium p-4 bg-white rounded-2xl shadow-sm hover-shadow-xl transition-all d-flex align-items-center justify-content-center border-2 border-dashed border-danger" style="height: 128px; text-decoration: none;">
                        <span class="text-danger font-weight-bold">VOTRE LOGO ICI</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('cooprom.presentation') }}" class="btn btn-link text-muted px-3">Présentation</a>
                <a href="{{ route('cooprom.missions') }}" class="btn btn-link text-muted px-3">Missions</a>
                <a href="{{ route('cooprom.partenaires') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Partenaires</a>
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
    .rounded-2xl { border-radius: 20px !important; }
    .rounded-xl { border-radius: 12px !important; }
    .shadow-2xl { box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.2); }

    .text-transparent-stroke-white {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .icon-circle { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }

    .hover-translate-r:hover { transform: translateX(10px); background: #ff3c36 !important; color: white !important; }
    .hover-translate-r:hover .icon-circle { background: white; color: #ff3c36; }

    .partner-card-premium { border: 1px solid #f0f0f0; min-height: 120px; display: flex; align-items: center; justify-content: center; }
    .grayscale-100 { filter: grayscale(100%); opacity: 0.6; }
    .group-hover-color:hover { filter: grayscale(0%); opacity: 1; transform: scale(1.1); }

    .hover-shadow-xl:hover { box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
