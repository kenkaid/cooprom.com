@extends('front.layouts.app')

@section('title', 'Conseil Juridique - COOPROM | Sécurisation de Carrière')

@section('content')
    <!-- Legal Hero Section -->
    <section class="legal-hero position-relative d-flex align-items-center text-white overflow-hidden" style="min-height: 60vh; background: #1a1a1a;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/resource/members/legal.jpeg') }}) center/cover fixed; opacity: 0.3;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(90deg, #1a1a1a 0%, transparent 100%);"></div>

        <div class="auto-container position-relative z-index-1">
            <div class="row">
                <div class="col-lg-7 animate-left">
                    <span class="badge bg-danger px-3 py-2 mb-3 text-uppercase tracking-widest font-weight-bold">Protection & Expertise</span>
                    <h1 class="display-3 font-weight-bold mb-4">Conseil <span class="text-danger">Juridique</span> & Droits d'Artiste</h1>
                    <p class="lead mb-5 text-white" style="opacity: 0.9;">Sécurisez votre talent. La COOPROM bâtit le cadre légal nécessaire à l'épanouissement de votre carrière nationale et internationale.</p>
                </div>
            </div>
        </div>

        <!-- Decoration Gavel Icon -->
        <div class="position-absolute d-none d-lg-block" style="top: 20%; right: 10%; opacity: 0.05; transform: rotate(15deg);">
            <i class="fas fa-gavel fa-15x text-white"></i>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="image-wrapper position-relative">
                        <div class="accent-border position-absolute w-100 h-100 border-2 border-danger rounded-2xl" style="top: 20px; left: 20px; z-index: 1;"></div>
                        <img src="{{ asset('assets/front/images/resource/juridique.jpeg') }}" alt="Juridique" class="img-fluid rounded-2xl shadow-2xl position-relative z-index-2 transform-hover-scale">
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="pl-lg-5">
                        <div class="sec-title-modern mb-4">
                            <h2 class="display-5 font-weight-bold">La Maîtrise des <span class="text-danger">Accords</span></h2>
                            <div class="title-line w-25 bg-danger mt-3" style="height: 4px;"></div>
                        </div>
                        <p class="text-dark mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                            Dans un milieu artistique de plus en plus complexe, la maîtrise du cadre juridique est la clé d'une carrière pérenne. La COOPROM déploie son expérience pour la rédaction et la négociation de vos contrats professionnels.
                        </p>

                        <div class="row g-4 mt-4">
                            <div class="col-12 mb-3">
                                <div class="d-flex align-items-center p-3 bg-light rounded-xl hover-bg-danger transition-all group">
                                    <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-shield-alt fa-xs"></i>
                                    </div>
                                    <span class="font-weight-bold">Protection de la Propriété Intellectuelle</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center p-3 bg-light rounded-xl hover-bg-danger transition-all group">
                                    <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-hand-holding-usd fa-xs"></i>
                                    </div>
                                    <span class="font-weight-bold">Garantie de Paiement des Droits</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid (Creative Cards) -->
    <section class="py-5 bg-light">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5 pb-5">
                <h2 class="font-weight-bold display-5">Nos Domaines d'Expertise</h2>
                <p class="text-muted">Des contrats types adaptés à chaque besoin métier.</p>
            </div>

            <div class="row g-4">
                @php
                    $legalServices = [
                        ['icon' => 'fas fa-file-contract', 'title' => 'Production', 'desc' => 'Encadrez vos relations avec les producteurs et studios.'],
                        ['icon' => 'fas fa-shipping-fast', 'title' => 'Distribution', 'desc' => 'Sécurisez la diffusion de vos œuvres sur toutes les plateformes.'],
                        ['icon' => 'fas fa-paint-brush', 'title' => 'Exposition', 'desc' => 'Garantissez les conditions de monstration de vos créations.'],
                    ];
                @endphp

                @foreach($legalServices as $index => $service)
                <div class="col-lg-4 mb-4 animate-up" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="legal-card-creative p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-2xl transition-all text-center">
                        <div class="icon-box-legal mb-4 text-danger">
                            <i class="{{ $service['icon'] }} fa-3x"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Contrat de {{ $service['title'] }}</h4>
                        <p class="text-muted small">{{ $service['desc'] }}</p>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-link text-danger font-weight-bold p-0">Demander un modèle <i class="fas fa-chevron-right ml-1"></i></a>
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
                <a href="{{ route('assistance.visa') }}" class="btn btn-link text-muted px-3">Visa</a>
                <a href="{{ route('assistance.legal') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Juridique</a>
                <a href="{{ route('assistance.social') }}" class="btn btn-link text-muted px-3">Social</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.3em; }
    .rounded-2xl { border-radius: 30px !important; }
    .rounded-xl { border-radius: 15px !important; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2); }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }

    .transform-hover-scale:hover { transform: scale(1.02); transition: 0.5s; }

    .hover-bg-danger:hover { background: #ff3c36 !important; color: white !important; }
    .hover-bg-danger:hover .icon-sm { background: white !important; color: #ff3c36 !important; }

    .legal-card-creative { border: 1px solid #f5f5f5; }
    .legal-card-creative:hover { transform: translateY(-10px); border-color: #ff3c36; }
    .hover-shadow-2xl:hover { box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.1) !important; }

    .fa-15x { font-size: 15rem; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
