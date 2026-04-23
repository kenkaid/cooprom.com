@extends('front.layouts.app')

@section('title', 'Assistance Visa - COOPROM | Accompagnement International')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Assistance Visa</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Assistance</li>
                    <li>Visa</li>
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
                                    <li class="active"><a href="{{ route('assistance.visa') }}">Assistance Visa</a></li>
                                    <li><a href="{{ route('assistance.legal') }}">Conseil Juridique</a></li>
                                    <li><a href="{{ route('assistance.social') }}">Aide Sociale</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-dark text-white p-4 rounded text-center border-top border-danger border-lg">
                                <div class="icon-box mb-3"><span class="fas fa-passport text-danger h1"></span></div>
                                <h4 class="text-white">Mobilité Artiste</h4>
                                <p class="small">Nous facilitons vos démarches administratives pour vos tournées mondiales.</p>
                                <a href="#" class="theme-btn btn-style-one bg_red btn-sm mt-3"><span class="btn-title">Demander une orientation</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-3.jpg') }}" alt="Assistance Visa COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">MOBILITÉ INTERNATIONALE</span>
                            <h2 class="font-weight-bold">Ouvrez les portes des scènes étrangères</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">L'assistance de la COOPROM consiste à assister, à orienter et à informer l’adhérant sur son type de visa et les documents exigés par l’ambassade du pays qu’il souhaite visiter dans le cadre de sa carrière.</p>
                            <p class="mb-4">Participer à un festival ou une exposition internationale demande une préparation rigoureuse. Nous mettons notre expertise à votre disposition pour maximiser les chances de réussite de vos dossiers.</p>
                        </div>

                        <!-- Visa Steps -->
                        <div class="row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="step-card p-4 bg-white shadow-sm rounded h-100 border-left border-danger transition-y">
                                    <div class="icon text-danger h2 mb-3"><i class="fas fa-info-circle"></i></div>
                                    <h5 class="font-weight-bold">Information & Conseil</h5>
                                    <p class="small mb-0 text-muted">Identification du type de visa adapté à votre mission culturelle (Performance, Business, Culture).</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="step-card p-4 bg-white shadow-sm rounded h-100 border-left border-danger transition-y">
                                    <div class="icon text-danger h2 mb-3"><i class="fas fa-file-invoice"></i></div>
                                    <h5 class="font-weight-bold">Dossier Documentaire</h5>
                                    <p class="small mb-0 text-muted">Aide à la constitution de la liste des documents exigés par les ambassades et consulats.</p>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Notre Expertise Voyage</h3>
                        </div>
                        <div class="text text-justify mb-4">
                            <p>Grâce à nos relations privilégiées avec les ambassades de Côte d'Ivoire à l'étranger, nous offrons un accompagnement unique :</p>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Orientation personnalisée selon la destination.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Vérification de la conformité des pièces justificatives.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Inscription aux événements et séminaires étrangers.</li>
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
    .border-lg { border-top-width: 5px !important; }
</style>
@endsection
