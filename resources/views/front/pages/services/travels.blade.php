@extends('front.layouts.app')

@section('title', 'Voyages d\'Affaires - COOPROM | Networking International')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Voyages d'Affaires</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Services</li>
                    <li>Voyages</li>
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
                                    <li class="active"><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                    <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Travel Special Widget -->
                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-dark text-white p-4 rounded text-center border-top border-danger border-lg">
                                <div class="icon-box mb-3"><span class="fas fa-plane-departure text-danger h1"></span></div>
                                <h4 class="text-white">Assistance Visa</h4>
                                <p class="small">Nous vous orientons sur les documents exigés pour vos missions internationales.</p>
                                <a href="#" class="theme-btn btn-style-one bg_red btn-sm mt-3"><span class="btn-title">Vérifier mon éligibilité</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-3.jpg') }}" alt="Voyages d'Affaires COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">NETWORKING MONDIAL</span>
                            <h2 class="font-weight-bold">Connectez votre art au reste du monde</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">Le voyage d'affaires à la COOPROM a pour but d’améliorer la qualité des travaux des participants en vue d’assurer la promotion de leur œuvre grâce à l’expertise étrangère et les échanges culturels de haut niveau.</p>
                            <p class="mb-4">Nous programmons durant toute l’année des voyages de groupe consistant à mettre en relation les artistes, professionnels et chefs d’entreprises culturelles avec leurs homologues du monde entier.</p>
                        </div>

                        <!-- Travel Features -->
                        <div class="row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="travel-feature d-flex align-items-center p-3 bg-white shadow-sm rounded border-left border-danger">
                                    <div class="icon mr-3 text-danger h3"><i class="fas fa-users-cog"></i></div>
                                    <h6 class="mb-0 font-weight-bold">Mise en relation B2B</h6>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="travel-feature d-flex align-items-center p-3 bg-white shadow-sm rounded border-left border-danger">
                                    <div class="icon mr-3 text-danger h3"><i class="fas fa-passport"></i></div>
                                    <h6 class="mb-0 font-weight-bold">Orientation Visa</h6>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="travel-feature d-flex align-items-center p-3 bg-white shadow-sm rounded border-left border-danger">
                                    <div class="icon mr-3 text-danger h3"><i class="fas fa-handshake"></i></div>
                                    <h6 class="mb-0 font-weight-bold">Recherche de débouchés</h6>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="travel-feature d-flex align-items-center p-3 bg-white shadow-sm rounded border-left border-danger">
                                    <div class="icon mr-3 text-danger h3"><i class="fas fa-certificate"></i></div>
                                    <h6 class="mb-0 font-weight-bold">Expertise Étrangère</h6>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Dynamiser l'Action Culturelle</h3>
                        </div>
                        <div class="text text-justify mb-4">
                            <p>En un mot, il s’agit de dynamiser l’action culturelle et artistique pour soutenir le progrès matériel de nos artistes et leurs œuvres. La COOPROM procède également à vos inscriptions pour :</p>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check text-danger mr-3"></i> Séminaires et formations internationales.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check text-danger mr-3"></i> Participation à des festivals de renom.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check text-danger mr-3"></i> Missions de prospection commerciale.</li>
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
    .border-lg { border-top-width: 5px !important; }
</style>
@endsection
