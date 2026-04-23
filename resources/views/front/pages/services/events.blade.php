@extends('front.layouts.app')

@section('title', 'Événementiel - COOPROM | Festivals & Spectacles Mondiaux')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Événementiel</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Services</li>
                    <li>Événementiel</li>
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
                                    <li><a href="{{ route('services.production') }}">Production Numérique</a></li>
                                    <li><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                    <li class="active"><a href="{{ route('services.events') }}">Événementiel</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-red text-white p-4 rounded text-center">
                                <div class="icon-box mb-3"><span class="fas fa-calendar-star text-white h1"></span></div>
                                <h4 class="text-white">Prochain Festival</h4>
                                <p class="small text-white">Découvrez le calendrier des événements culturels africains.</p>
                                <a href="#" class="theme-btn btn-style-one bg-white text-danger btn-sm mt-3"><span class="btn-title" style="color:#ff3c36;">Voir le calendrier</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-4.jpg') }}" alt="Événementiel COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">SPECTACLES & FESTIVALS</span>
                            <h2 class="font-weight-bold">L'art de l'organisation et de la rencontre</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">La COOPROM est un carrefour pour l’organisation de spectacles et d’événements culturels en Côte d’Ivoire et partout dans le monde entier. Nous orchestrons des moments uniques pour célébrer le talent de nos adhérents.</p>
                            <p class="mb-4">Qu’il s’agisse de séminaires, de foires, de festivals ou d’expositions, notre équipe dynamique met tout en œuvre pour assurer le succès logistique et médiatique de chaque projet.</p>
                        </div>

                        <!-- Event Types -->
                        <div class="row mt-5">
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="event-type-card p-3 bg-white shadow-sm rounded text-center transition-y border-bottom border-danger">
                                    <div class="icon text-danger mb-2"><i class="fas fa-music fa-2x"></i></div>
                                    <h6 class="font-weight-bold">Festivals</h6>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="event-type-card p-3 bg-white shadow-sm rounded text-center transition-y border-bottom border-danger">
                                    <div class="icon text-danger mb-2"><i class="fas fa-palette fa-2x"></i></div>
                                    <h6 class="font-weight-bold">Expositions</h6>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="event-type-card p-3 bg-white shadow-sm rounded text-center transition-y border-bottom border-danger">
                                    <div class="icon text-danger mb-2"><i class="fas fa-chalkboard-teacher fa-2x"></i></div>
                                    <h6 class="font-weight-bold">Séminaires</h6>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Valorisation Folklorique</h3>
                        </div>
                        <div class="text text-justify mb-4">
                            <p>Une de nos missions prioritaires est la promotion et la valorisation des danses folkloriques et traditionnelles africaines. Nous organisons des rencontres thématiques pour :</p>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-star text-danger mr-3"></i> Mettre en avant le terroir ivoirien.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-star text-danger mr-3"></i> Organiser des congrès et forums culturels.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-star text-danger mr-3"></i> Gérer la logistique de tournées artistiques.</li>
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
</style>
@endsection
