@extends('front.layouts.app')

@section('title', 'Production Numérique - COOPROM | Technologie Temps Réel')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Production Numérique</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Services</li>
                    <li>Production</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Service Detail Section -->
    <section class="service-detail-section py-5">
        <div class="auto-container py-4">
            <div class="row">
                <!-- Sidebar Column -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar bg-light p-4 rounded shadow-sm">
                        <div class="sidebar-widget categories-widget">
                            <div class="widget-content">
                                <ul class="services-categories">
                                    <li><a href="{{ route('services.promotion') }}">Promotion Artistique</a></li>
                                    <li class="active"><a href="{{ route('services.production') }}">Production Numérique</a></li>
                                    <li><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                    <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-red text-white p-4 rounded text-center">
                                <div class="icon-box mb-3"><span class="fas fa-video text-white h1"></span></div>
                                <h4 class="text-white">Studio Digital</h4>
                                <p class="small text-white">Donnez une dimension technologique à vos œuvres artistiques.</p>
                                <a href="#" class="theme-btn btn-style-one bg-white text-danger btn-sm mt-3"><span class="btn-title" style="color:#ff3c36;">En savoir plus</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-2.jpg') }}" alt="Production Numérique COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">NUMÉRIQUE & TEMPS RÉEL</span>
                            <h2 class="font-weight-bold">L'innovation technologique au service de l'art</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">La COOPROM offre aux artistes un accès privilégié à une plateforme de production axée sur les pratiques artistiques et culturelles modernes, portées par les nouvelles technologies dites <strong>"temps réel"</strong>.</p>
                            <p class="mb-4">Notre objectif est d'accompagner l'artiste ivoirien dans sa transition vers le numérique, en lui offrant les outils et la formation nécessaires pour créer des œuvres immersives et impactantes.</p>
                        </div>

                        <!-- Production Grid -->
                        <div class="row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="production-card p-4 border rounded shadow-sm h-100 text-center transition-y">
                                    <div class="icon text-danger h1 mb-3"><i class="fas fa-film"></i></div>
                                    <h5 class="font-weight-bold">Cinéma & Clips</h5>
                                    <p class="small text-muted">Réalisation de clips vidéo et projets cinématographiques de haute qualité.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="production-card p-4 border rounded shadow-sm h-100 text-center transition-y">
                                    <div class="icon text-danger h1 mb-3"><i class="fas fa-vr-cardboard"></i></div>
                                    <h5 class="font-weight-bold">Galeries Virtuelles</h5>
                                    <p class="small text-muted">Exposition de vos œuvres dans des espaces numériques accessibles mondialement.</p>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Accompagnement Numérique</h3>
                        </div>
                        <div class="text text-justify mb-5">
                            <p>Nous développons un réseau de partenaires experts pour favoriser les échanges d’expériences et la co-production numérique. Nos adhérents bénéficient de :</p>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-microchip text-danger mr-3"></i> Formation aux outils numériques de production.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-project-diagram text-danger mr-3"></i> Support technique pour les projets "Temps Réel".</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-tv text-danger mr-3"></i> Réalisation de publi-reportages institutionnels.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .services-categories { list-style: none; padding-left: 0; }
    .services-categories li { border-bottom: 1px solid #eee; }
    .services-categories li a { display: block; padding: 12px 0; color: #333; transition: 0.3s; font-weight: 500; }
    .services-categories li.active a, .services-categories li a:hover { color: #ff3c36; padding-left: 10px; }
    .transition-y:hover { transform: translateY(-10px); transition: 0.3s; }
    .bg-red { background-color: #ff3c36; }
</style>
@endsection
