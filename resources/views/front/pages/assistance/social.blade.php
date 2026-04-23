@extends('front.layouts.app')

@section('title', 'Aide Sociale - COOPROM | Solidarité aux Adhérents')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Aide Sociale</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Assistance</li>
                    <li>Social</li>
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
                                    <li><a href="{{ route('assistance.visa') }}">Assistance Visa</a></li>
                                    <li><a href="{{ route('assistance.legal') }}">Conseil Juridique</a></li>
                                    <li class="active"><a href="{{ route('assistance.social') }}">Aide Sociale</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-dark text-white p-4 rounded text-center">
                                <div class="icon-box mb-3"><span class="fas fa-heart text-danger h1"></span></div>
                                <h4 class="text-white">Cœur Solidaire</h4>
                                <p class="small">La COOPROM, c'est aussi une famille qui soutient ses membres dans les moments difficiles.</p>
                                <a href="#" class="theme-btn btn-style-one bg_red btn-sm mt-3"><span class="btn-title">Nous contacter</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/image-1.jpg') }}" alt="Aide Sociale COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">SOLIDARITÉ & ENTRAIDE</span>
                            <h2 class="font-weight-bold">Une assistance sociale au service de l'adhérent</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">Au-delà de la promotion et de la production, la COOPROM apporte une assistance sociale à ses adhérents. Nous croyons que le bien-être social de l'artiste est le socle de sa créativité.</p>
                            <p class="mb-4">Conformément à nos valeurs de coopérative, nous mettons en place des mécanismes de soutien pour accompagner nos membres dans leur vie quotidienne et professionnelle.</p>
                        </div>

                        <!-- Social Benefits -->
                        <div class="row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="benefit-box p-4 bg-white shadow-sm rounded h-100 border-top border-danger transition-y text-center">
                                    <div class="icon text-danger h1 mb-3"><i class="fas fa-hand-holding-heart"></i></div>
                                    <h5 class="font-weight-bold">Soutien Moral</h5>
                                    <p class="small text-muted">Écoute et orientation pour les artistes en situation de fragilité.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="benefit-box p-4 bg-white shadow-sm rounded h-100 border-top border-danger transition-y text-center">
                                    <div class="icon text-danger h1 mb-3"><i class="fas fa-medkit"></i></div>
                                    <h5 class="font-weight-bold">Accompagnement Aide</h5>
                                    <p class="small text-muted">Mécanismes d'aide ponctuelle selon les besoins de l'adhérent.</p>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Nos Engagements Sociaux</h3>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Mise en réseau pour la solidarité entre membres.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Information sur la protection sociale de l'artiste.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-danger mr-3"></i> Aide à la résolution de problématiques matérielles.</li>
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
