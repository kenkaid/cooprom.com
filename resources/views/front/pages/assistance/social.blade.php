@extends('front.layouts.app')

@section('title', 'Aide Sociale - COOPROM | Solidarité & Bienveillance')

@section('content')
    <!-- Social Hero Section -->
    <section class="social-hero position-relative d-flex align-items-center text-white overflow-hidden" style="min-height: 70vh; background: #964b48;">
        <!-- Pattern background decoration -->
        <div class="position-absolute w-100 h-100 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>

        <div class="auto-container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-7 animate-left">
                    <h5 class="font-weight-bold text-uppercase mb-3 tracking-widest text-white-50">L'Esprit Coopératif</h5>
                    <h1 class="display-3 font-weight-bold mb-4">Solidarité & <br><span class="text-white">Bienveillance</span></h1>
                    <p class="lead mb-5 text-white" style="opacity: 0.95;">La COOPROM, c'est avant tout une famille. Nous veillons au bien-être social de nos artistes, car une création sereine nait d'une vie protégée.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-white btn-lg rounded-pill px-5 shadow-lg">Nous contacter</a>
                </div>
                <div class="col-lg-5 d-none d-lg-block animate-right">
                    <div class="hero-icon-box text-center">
                        <i class="fas fa-hand-holding-heart fa-15x opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="image-box position-relative p-4">
                        <div class="heart-shape-bg position-absolute" style="width: 100%; height: 100%; top:0; left:0; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); z-index: 1; opacity: 0.2; background-color: #964b48;"></div>
                        <img src="{{ asset('assets/front/images/resource/social_aide_resized.jpeg') }}" alt="Social" class="img-fluid rounded-3xl shadow-2xl position-relative z-index-2 transform-hover-float">
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="pl-lg-5">
                        <div class="sec-title-modern mb-4">
                            <h2 class="display-5 font-weight-bold">Plus qu'une Institution, <br><span style="color: #964b48;">Une Famille</span></h2>
                        </div>
                        <p class="text-dark mb-4 lead" style="line-height: 1.8;">
                            Nous croyons que le bien-être social de l'artiste est le socle de sa créativité. Conformément à nos valeurs de coopérative, nous mettons en place des mécanismes de soutien concrets.
                        </p>

                        <div class="feature-checks mt-5">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle mr-3 fa-lg" style="color: #964b48;"></i>
                                <span class="font-weight-bold">Écoute et orientation personnalisée</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle mr-3 fa-lg" style="color: #964b48;"></i>
                                <span class="font-weight-bold">Mise en réseau solidaire entre membres</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle mr-3 fa-lg" style="color: #964b48;"></i>
                                <span class="font-weight-bold">Information sur la protection sociale</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Mechanism (Creative Grid) -->
    <section class="py-5 bg-light">
        <div class="auto-container py-5">
            <div class="sec-title text-center mb-5 pb-5">
                <h2 class="font-weight-bold display-5">Nos Mécanismes de Soutien</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 animate-up">
                    <div class="social-card p-5 bg-white h-100 rounded-2xl shadow-sm hover-shadow-xl transition-all border-left-5" style="border-left-color: #964b48 !important;">
                        <div class="icon mb-4" style="color: #964b48;"><i class="fas fa-heartbeat fa-3x"></i></div>
                        <h4 class="font-weight-bold mb-3">Soutien Moral</h4>
                        <p class="text-muted">Un service dédié pour accompagner les artistes traversant des périodes de fragilité ou de doute dans leur carrière.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4 animate-up" style="animation-delay: 0.2s;">
                    <div class="social-card p-5 bg-dark text-white h-100 rounded-2xl shadow-xl transition-all">
                        <div class="icon text-danger mb-4"><i class="fas fa-plus-square fa-3x"></i></div>
                        <h4 class="font-weight-bold mb-3 text-white">Aide Ponctuelle</h4>
                        <p class="text-white" style="opacity: 0.9;">Activation de fonds de solidarité et assistance matérielle lors d'événements de vie majeurs de nos adhérents.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('assistance.visa') }}" class="btn btn-link text-muted px-3">Visa</a>
                <a href="{{ route('assistance.legal') }}" class="btn btn-link text-muted px-3">Juridique</a>
                <a href="{{ route('assistance.social') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Social</a>
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
    .border-left-5 { border-left: 5px solid !important; }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.05); }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }

    .transform-hover-float:hover { transform: translateY(-10px) rotate(1deg); transition: 0.5s; }

    .social-card:hover { transform: scale(1.02); }
    .hover-shadow-xl:hover { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important; }

    .btn-outline-white { border: 2px solid white; color: white; transition: 0.3s; }
    .btn-outline-white:hover { background: white; color: #ff3c36; }

    .fa-15x { font-size: 15rem; }
    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
