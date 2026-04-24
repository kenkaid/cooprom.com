@extends('front.layouts.app')

@section('title', 'Présentation - COOPROM | Notre Histoire et nos Missions')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Présentation de la COOPROM</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>La Cooprom</li>
                    <li>Présentation</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Presentation Section -->
    <section class="about-section-two py-5">
        <div class="auto-container">
            <div class="row align-items-center">
                <!-- Content Column -->
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column pr-lg-5">
                        <div class="sec-title">
                            <span class="title">DEPUIS 2005</span>
                            <h2 class="font-weight-bold">Une coopérative au cœur de la <span class="text-danger">promotion artistique</span></h2>
                        </div>
                        <div class="text text-justify" style="font-size: 1.1rem; line-height: 1.8;">
                            <p class="mb-4">Régie par la loi n° 97_721 relative aux coopératives, la <strong>COOPROM</strong> (Coopérative de la Promotion des artistes) est une institution culturelle spécialisée dans l’accompagnement de carrière pour toutes les tendances artistiques.</p>
                            <p>Notre mission est de propulser la créativité ivoirienne sur la scène internationale en apportant une assistance technique, matérielle et stratégique à nos adhérents.</p>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="info-box-three d-flex align-items-center mb-4">
                                    <div class="icon-wrap mr-3 bg-red p-3 rounded-circle text-white" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <span class="fas fa-bullhorn" style="font-size: 24px;"></span>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 font-weight-bold">Promotion</h5>
                                        <small>Diffusion mondiale</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box-three d-flex align-items-center mb-4">
                                    <div class="icon-wrap mr-3 bg-red p-3 rounded-circle text-white" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <span class="fas fa-hands-helping" style="font-size: 24px;"></span>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 font-weight-bold">Assistance</h5>
                                        <small>Conseil & Matériel</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-5 col-md-12 col-sm-12 mt-lg-0 mt-5">
                    <div class="inner-column position-relative">
                        <div class="image-box p-3 bg-white shadow-lg rounded">
                            <figure class="image overflow-hidden rounded mb-0">
                                <img src="{{ asset('assets/front/images/resource/prez.jpg') }}" alt="COOPROM Equipe" class="img-fluid transform-scale">
                            </figure>
                        </div>
                        <div class="experience-badge bg-red text-white p-4 rounded shadow-lg position-absolute" style="bottom: -30px; left: -30px; z-index: 2;">
                            <span class="year h1 d-block mb-0 font-weight-bold">20</span>
                            <div class="text text-uppercase small font-weight-bold">Années <br> d'Expertise</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Missions Grid Section -->
    <section class="missions-section bg-light py-5">
        <div class="auto-container">
            <div class="sec-title-two text-center mb-5">
                <span class="title">NOS MISSIONS</span>
                <h3 class="font-weight-bold">Une vision stratégique pour l'artiste</h3>
            </div>

            <div class="row">
                <!-- Mission Blocks avec design épuré -->
                @php
                    $missions = [
                        ['icon' => 'fas fa-tools', 'title' => 'Amélioration des techniques', 'text' => 'Optimiser la promotion et la production artistique pour un progrès matériel durable.'],
                        ['icon' => 'fas fa-globe-africa', 'title' => 'Rayonnement International', 'text' => 'Valoriser l’art ivoirien hors des frontières via nos représentations mondiales.'],
                        ['icon' => 'fas fa-users', 'title' => 'Réseautage Stratégique', 'text' => 'Connecter nos artistes avec des investisseurs et acteurs majeurs du milieu culturel.'],
                        ['icon' => 'fas fa-gavel', 'title' => 'Sécurité Juridique', 'text' => 'Expertise dans la rédaction de contrats de production, exposition et distribution.'],
                        ['icon' => 'fas fa-plane-departure', 'title' => 'Voyages d\'Affaires', 'text' => 'Programmation et assistance pour vos missions culturelles partout dans le monde.'],
                        ['icon' => 'fas fa-comments', 'title' => 'Pôles d\'Échange', 'text' => 'Création de points de contact dans les ambassades pour favoriser les débouchés.'],
                    ];
                @endphp

                @foreach($missions as $mission)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="mission-card h-100 p-4 bg-white shadow-sm rounded border-bottom border-danger transition-y">
                        <div class="icon text-danger h1 mb-3"><span class="{{ $mission['icon'] }}"></span></div>
                        <h4 class="font-weight-bold mb-3 h5">{{ $mission['title'] }}</h4>
                        <p class="text-muted small mb-0">{{ $mission['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Value Added (Fluid Section) -->
    <section class="value-added py-0">
        <div class="row no-gutters">
            <div class="col-lg-6 bg_red p-5 d-flex align-items-center text-white">
                <div class="inner-column p-lg-5">
                    <div class="sec-title-two mb-4">
                        <span class="title text-white">VALEUR AJOUTÉE</span>
                        <h3 class="text-white font-weight-bold">Pourquoi choisir la COOPROM ?</h3>
                    </div>
                    <p class="mb-5 opacity-8">Nous aidons l’artiste africain à combler les insuffisances de son environnement de travail grâce à des méthodes innovantes.</p>
                    <ul class="list-style-three">
                        <li class="mb-3 d-flex align-items-center"><i class="fa fa-check-circle mr-3"></i> Diffusion internationale de vos œuvres</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa fa-check-circle mr-3"></i> Valorisation des danses traditionnelles</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa fa-check-circle mr-3"></i> Accompagnement numérique & formation</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa fa-check-circle mr-3"></i> Participation aux grands festivals mondiaux</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 bg-image" style="background-image: url({{ asset('assets/front/images/resource/image-3.jpg') }}); min-height: 500px;">
                <!-- background-image via CSS -->
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section-three py-5 bg-dark text-white text-center">
        <div class="auto-container py-4">
            <h2 class="mb-4 font-weight-bold">Prêt à faire décoller votre talent ?</h2>
            <p class="mb-5 lead opacity-8" style="color: white; !important;">Rejoignez une équipe dynamique prête à valoriser votre art partout dans le monde.</p>
            <a href="#" class="theme-btn btn-style-one bg_red shadow-lg px-5 py-3">
                <span class="btn-title">Devenir Adhérent</span>
            </a>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .transition-y:hover { transform: translateY(-10px); transition: 0.3s; }
    .opacity-8 { opacity: 0.8; }
    .bg-red { background-color: #ff3c36; }
    .list-style-three { list-style: none; padding-left: 0; }
    .list-style-three i { font-size: 1.2rem; }
    .transform-scale { transition: 0.5s; }
    .transform-scale:hover { transform: scale(1.05); }
    .bg-image { background-size: cover; background-position: center; }
</style>
@endsection
