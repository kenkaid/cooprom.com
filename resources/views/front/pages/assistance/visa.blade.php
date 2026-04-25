@extends('front.layouts.app')

@section('title', 'Assistance Visa - COOPROM | Accompagnement International')

@section('content')
    <!-- Visa Hero Section -->
    <section class="visa-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 70vh; background: #000;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/resource/members/visa.jpeg') }}) center/cover fixed; opacity: 0.5;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent, rgba(255,60,54,0.6));"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Mobilité Sans Frontières</h5>
            <h1 class="display-2 font-weight-bold mb-4">Votre <span class="text-white">Visa</span> pour le succès</h1>
            <p class="lead mb-5 max-width-700 mx-auto text-white" style="opacity: 0.95;">La COOPROM simplifie vos démarches administratives internationales pour que votre talent n'ait aucune limite géographique.</p>
            <div class="hero-btns">
                <a href="{{ route('member.travels.create_visa') }}" class="theme-btn btn-style-one px-5">
                    <span class="btn-title">Démarrer une demande <i class="fas fa-passport ml-2"></i></span>
                </a>
            </div>
        </div>

        <!-- Floating Cloud/Plane Decoration -->
        <div class="position-absolute animate-float" style="top: 20%; left: 5%; opacity: 0.1;">
            <i class="fas fa-cloud fa-5x"></i>
        </div>
        <div class="position-absolute animate-float" style="bottom: 30%; right: 10%; opacity: 0.1; animation-delay: 2s;">
            <i class="fas fa-plane fa-7x"></i>
        </div>
    </section>

    <!-- Strategy Section -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-left">
                    <div class="experience-box p-5 bg-light rounded-3xl shadow-xl position-relative">
                        <div class="sec-title-modern mb-4">
                            <h2 class="display-5 font-weight-bold">L'Expertise du <span class="text-danger">Voyage Culturel</span></h2>
                        </div>
                        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                            Nous assistons, orientons et informons l’adhérant sur son type de visa et les documents exigés par l’ambassade du pays qu’il souhaite visiter dans le cadre de sa carrière. Maximisez vos chances de réussite avec un dossier impeccable.
                        </p>

                        <div class="visa-steps-list">
                            <div class="d-flex align-items-start mb-4">
                                <div class="step-num text-danger font-weight-bold display-4 opacity-20 mr-3 mt-n2">01</div>
                                <div>
                                    <h5 class="font-weight-bold mb-1">Analyse du Projet</h5>
                                    <p class="small text-muted mb-0">Identification du visa (Performance, Business ou Culture) adapté.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-4">
                                <div class="step-num text-danger font-weight-bold display-4 opacity-20 mr-3 mt-n2">02</div>
                                <div>
                                    <h5 class="font-weight-bold mb-1">Montage Documentaire</h5>
                                    <p class="small text-muted mb-0">Constitution rigoureuse de la liste des documents exigés.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="step-num text-danger font-weight-bold display-4 opacity-20 mr-3 mt-n2">03</div>
                                <div>
                                    <h5 class="font-weight-bold mb-1">Accompagnement Diplomatique</h5>
                                    <p class="small text-muted mb-0">Utilisation de nos pôles de contacts stratégiques à l'étranger.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-right">
                    <div class="image-wrapper position-relative pl-lg-5">
                        <div class="creative-border position-absolute w-100 h-100 border-2 border-danger rounded-2xl" style="top: -20px; right: -20px; z-index: 1;"></div>
                        <img src="{{ asset('assets/front/images/resource/11_resized.jpeg') }}" alt="Visa" class="img-fluid rounded-2xl shadow-2xl position-relative z-index-2 transform-hover-float">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- World Presence Preview -->
    <section class="py-5 bg-dark text-white text-center position-relative overflow-hidden">
        <div class="auto-container py-5 z-index-1">
            <h2 class="display-4 font-weight-bold mb-4">Un Rayonnement <span class="text-danger">Sans Frontières</span></h2>
            <p class="lead mb-5 text-white" style="opacity: 0.95;">Schengen, USA, Afrique, Asie... la COOPROM vous accompagne vers toutes les destinations culturelles majeures.</p>

            <div class="row opacity-30 mt-5 g-5">
                <div class="col-3"><i class="fas fa-landmark fa-4x mb-2"></i><br><small>Schengen</small></div>
                <div class="col-3"><i class="fas fa-city fa-4x mb-2"></i><br><small>USA/Canada</small></div>
                <div class="col-3"><i class="fas fa-torii-gate fa-4x mb-2"></i><br><small>Asie</small></div>
                <div class="col-3"><i class="fas fa-globe-africa fa-4x mb-2"></i><br><small>Afrique</small></div>
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('assistance.visa') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Visa</a>
                <a href="{{ route('assistance.legal') }}" class="btn btn-link text-muted px-3">Juridique</a>
                <a href="{{ route('assistance.social') }}" class="btn btn-link text-muted px-3">Social</a>
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
    .max-width-700 { max-width: 700px; }
    .max-width-600 { max-width: 600px; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }
    .animate-float { animation: float 6s ease-in-out infinite; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes float { 0% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-20px) rotate(5deg); } 100% { transform: translateY(0px) rotate(0deg); } }

    .transform-hover-float:hover { transform: translateY(-15px); transition: 0.5s; }
    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection
