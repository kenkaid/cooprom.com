@extends('front.layouts.app')

@section('title', 'Contactez l\'Élite - COOPROM | Votre Partenaire Culturel')

@section('content')
    <!-- Creative Contact Hero -->
    <section class="contact-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="min-height: 50vh; background: #000;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/contact.jpeg') }}) center/cover fixed; opacity: 0.4;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent, #000);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Prendre Contact</h5>
            <h1 class="display-3 font-weight-bold mb-0">Parlons de <span class="text-transparent-stroke-white">votre projet</span></h1>
            <div class="divider mx-auto bg-danger mt-4" style="width: 80px; height: 5px; border-radius: 10px;"></div>
        </div>
    </section>

    <!-- Main Contact Section (Creative Layout) -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="auto-container py-5">
            <div class="row g-5">
                <!-- Info Column (Cards Style) -->
                <div class="col-lg-5 animate-left">
                    <div class="contact-info-cards pr-lg-4">
                        <div class="sec-title-modern mb-5">
                            <h2 class="display-5 font-weight-bold">Nos <span class="text-danger">Coordonnées</span></h2>
                            <p class="text-muted">Une équipe à votre écoute pour propulser votre art.</p>
                        </div>

                        <!-- Info Card 1 -->
                        <div class="info-card-premium p-4 mb-4 bg-light rounded-2xl transition-all hover-translate-y group">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-danger text-white mr-4 shadow-lg group-hover-bounce" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-map-marker-alt fa-lg"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-uppercase font-weight-bold text-danger">Localisation</span>
                                    <span class="font-weight-bold h5">Abidjan, Cocody Angré</span>
                                </div>
                            </div>
                        </div>

                        <!-- Info Card 2 -->
                        <div class="info-card-premium p-4 mb-4 bg-light rounded-2xl transition-all hover-translate-y group">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-danger text-white mr-4 shadow-lg group-hover-bounce" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-phone-alt fa-lg"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-uppercase font-weight-bold text-danger">Téléphone</span>
                                    <a href="tel:+2250102030405" class="font-weight-bold h5 text-dark">+225 01 02 03 04 05</a>
                                </div>
                            </div>
                        </div>

                        <!-- Info Card 3 -->
                        <div class="info-card-premium p-4 mb-5 bg-light rounded-2xl transition-all hover-translate-y group">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-danger text-white mr-4 shadow-lg group-hover-bounce" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-uppercase font-weight-bold text-danger">Email</span>
                                    <a href="mailto:contact@cooprom.ci" class="font-weight-bold h5 text-dark">contact@cooprom.ci</a>
                                </div>
                            </div>
                        </div>

                        <!-- Social Network Icons -->
                        <div class="social-links-creative mt-5">
                            <h6 class="font-weight-bold text-uppercase mb-3 small opacity-50">Suivez l'institution :</h6>
                            <div class="d-flex">
                                <a href="#" class="social-btn mr-3"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-btn mr-3"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-btn mr-3"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column (Modern Style) -->
                <div class="col-lg-7 animate-right">
                    <div class="contact-form-creative p-5 bg-white rounded-3xl shadow-2xl border border-light position-relative overflow-hidden">
                        <!-- Decoration background -->
                        <div class="bg-decoration position-absolute opacity-05" style="top:-50px; right:-50px; transform: rotate(15deg);">
                            <i class="fas fa-paper-plane fa-15x text-danger"></i>
                        </div>

                        <div class="position-relative z-index-2">
                            <h3 class="font-weight-bold mb-4">Envoyez-nous un <span class="text-danger">Message</span></h3>

                            @if(session('success'))
                                <div class="alert alert-success border-0 rounded-xl shadow-sm mb-4">
                                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="post" id="creative-contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" name="first_name" class="form-control creative-input" id="first_name" placeholder="Prénom" required>
                                            <label for="first_name" class="text-muted small uppercase">Prénom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" name="last_name" class="form-control creative-input" id="last_name" placeholder="Nom" required>
                                            <label for="last_name" class="text-muted small uppercase">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control creative-input" id="email" placeholder="Email" required>
                                            <label for="email" class="text-muted small uppercase">Votre Email Professionnel</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <input type="text" name="phone" class="form-control creative-input" id="phone" placeholder="Téléphone">
                                            <label for="phone" class="text-muted small uppercase">Téléphone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating">
                                            <textarea name="contact_message" class="form-control creative-input" id="message" style="height: 150px" placeholder="Votre message" required></textarea>
                                            <label for="message" class="text-muted small uppercase">Comment pouvons-nous vous aider ?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="theme-btn btn-style-one w-100 py-3 shadow-xl">
                                            <span class="btn-title">Propulser ma demande <i class="fas fa-paper-plane ml-2"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Immersive) -->
    <section class="py-0 position-relative" style="height: 500px;">
        <div class="map-overlay position-absolute w-100 h-100 z-index-1 pointer-events-none" style="background: linear-gradient(to bottom, #fff, transparent 20%, transparent 80%, #fff);"></div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127116.31175480252!2d-4.045952945281483!3d5.348434208449791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ea5311959121%3A0x3fe70ddce1922077!2sAbidjan!5e0!3m2!1sfr!2sci!4v1700000000000!5m2!1sfr!2sci" width="100%" height="100%" style="border:0; filter: grayscale(100%) contrast(1.2) opacity(0.8);" allowfullscreen="" loading="lazy"></iframe>

        <!-- Floating Visit Card -->
        <div class="position-absolute z-index-2 animate-up d-none d-md-block" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="bg-danger text-white p-4 rounded-xl shadow-2xl text-center" style="min-width: 250px;">
                <h5 class="font-weight-bold mb-2">Pôle Central COOPROM</h5>
                <p class="small mb-0">Nous vous accueillons du Lundi au Vendredi<br>08h - 17h</p>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    .tracking-widest { letter-spacing: 0.4em; }
    .rounded-3xl { border-radius: 40px !important; }
    .rounded-2xl { border-radius: 20px !important; }
    .rounded-xl { border-radius: 15px !important; }
    .shadow-2xl { box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.25); }
    .opacity-05 { opacity: 0.05; }

    .text-transparent-stroke-white {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-left { opacity: 0; animation: fadeInLeft 1s forwards; }
    .animate-right { opacity: 0; animation: fadeInRight 1s forwards; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }

    .info-card-premium { border: 1px solid #f0f0f0; transition: all 0.4s ease; }
    .info-card-premium:hover { background: #fff !important; transform: scale(1.03); border-color: #ff3c36; box-shadow: 0 10px 30px rgba(255, 60, 54, 0.1) !important; }
    .group:hover .group-hover-bounce { animation: bounce 1s infinite; }
    @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }

    .social-btn {
        width: 45px; height: 45px; border-radius: 12px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;
        color: #333; transition: 0.3s; font-size: 18px;
    }
    .social-btn:hover { background: #ff3c36; color: white; transform: translateY(-5px); }

    .creative-input {
        border-radius: 15px !important; border: 1px solid #eee !important; padding: 1rem !important; height: auto !important;
        background-color: #fcfcfc !important;
    }
    .creative-input:focus { border-color: #ff3c36 !important; box-shadow: 0 0 15px rgba(255, 60, 54, 0.1) !important; background-color: #fff !important; }

    .fa-15x { font-size: 15rem; }
    .uppercase { text-transform: uppercase; letter-spacing: 0.1em; }
</style>
@endsection
