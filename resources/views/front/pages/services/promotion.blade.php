@extends('front.layouts.app')

@section('title', 'Promotion Artistique - COOPROM | Valorisation & Diffusion')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Promotion Artistique</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Services</li>
                    <li>Promotion</li>
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
                                    <li class="active"><a href="{{ route('services.promotion') }}">Promotion Artistique</a></li>
                                    <li><a href="{{ route('services.production') }}">Production Numérique</a></li>
                                    <li><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                    <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-dark text-white p-4 rounded text-center">
                                <div class="icon-box mb-3"><span class="fas fa-bullhorn text-danger h1"></span></div>
                                <h4 class="text-white">Besoin d'aide ?</h4>
                                <p class="small">Contactez notre équipe de promotion pour booster votre visibilité.</p>
                                <a href="#" class="theme-btn btn-style-one bg_red btn-sm mt-3"><span class="btn-title">Contactez-nous</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-1.jpg') }}" alt="Promotion COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">TECHNIQUES MODERNES</span>
                            <h2 class="font-weight-bold">Propulsez votre art sur la scène mondiale</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8; font-size: 1.1rem;">
                            <p class="mb-4">La <strong>Promotion</strong> au sein de la COOPROM consiste à améliorer les techniques de promotion des artistes de toutes tendances confondues. Notre expertise englobe l’achat, la distribution, la vente, ainsi que l’importation et l’exportation d’œuvres artistiques et culturelles.</p>
                            <p class="mb-4">Nous ne nous contentons pas de diffuser ; nous créons des ponts entre le créateur et son public, que ce soit en Côte d’Ivoire ou partout dans le monde entier.</p>
                        </div>

                        <div class="row mt-5">
                            <!-- Feature Block -->
                            <div class="col-md-6 mb-4">
                                <div class="feature-box d-flex p-4 bg-white shadow-sm rounded h-100 border-bottom border-danger transition-y">
                                    <div class="icon text-danger mr-4 h2"><i class="fas fa-shopping-cart"></i></div>
                                    <div>
                                        <h5 class="font-weight-bold">Achat & Vente</h5>
                                        <p class="small mb-0">Gestion commerciale de vos œuvres sur les marchés nationaux et internationaux.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Feature Block -->
                            <div class="col-md-6 mb-4">
                                <div class="feature-box d-flex p-4 bg-white shadow-sm rounded h-100 border-bottom border-danger transition-y">
                                    <div class="icon text-danger mr-4 h2"><i class="fas fa-truck-loading"></i></div>
                                    <div>
                                        <h5 class="font-weight-bold">Exportation</h5>
                                        <p class="small mb-0">Facilitation de l'exportation de vos créations vers les galeries et festivals mondiaux.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Notre Valeur Ajoutée</h3>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Amélioration des techniques de promotion.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Recherche active de nouveaux débouchés mondiaux.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Stratégies de diffusion personnalisées par secteur.</li>
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
