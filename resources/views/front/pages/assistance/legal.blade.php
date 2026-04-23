@extends('front.layouts.app')

@section('title', 'Conseil Juridique - COOPROM | Sécurisation de Carrière')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Conseil Juridique</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>Assistance</li>
                    <li>Juridique</li>
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
                                    <li class="active"><a href="{{ route('assistance.legal') }}">Conseil Juridique</a></li>
                                    <li><a href="{{ route('assistance.social') }}">Aide Sociale</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget help-widget mt-4">
                            <div class="widget-content bg-red text-white p-4 rounded text-center">
                                <div class="icon-box mb-3"><span class="fas fa-gavel text-white h1"></span></div>
                                <h4 class="text-white">Expertise Légale</h4>
                                <p class="small text-white">Sécurisez vos droits et vos revenus avec nos contrats types.</p>
                                <a href="#" class="theme-btn btn-style-one bg-white text-danger btn-sm mt-3"><span class="btn-title" style="color:#ff3c36;">Consulter un expert</span></a>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Content Column -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-details pl-lg-4">
                        <div class="image-box mb-5">
                            <figure class="image rounded shadow-lg overflow-hidden"><img src="{{ asset('assets/front/images/resource/service-4.jpg') }}" alt="Conseil Juridique COOPROM"></figure>
                        </div>
                        <div class="sec-title-two mb-4">
                            <span class="title text-danger">PROTECTION & DROITS</span>
                            <h2 class="font-weight-bold">Un cadre légal solide pour votre talent</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.8;">
                            <p class="mb-4">La COOPROM met en place son expertise et son expérience pour la rédaction des contrats des artistes. Dans un milieu de plus en plus complexe, la maîtrise du cadre juridique est la clé d'une carrière pérenne.</p>
                            <p class="mb-4">Nous nous chargeons de fournir toutes les informations nécessaires en la matière et d'accompagner nos adhérents dans la négociation de leurs accords professionnels.</p>
                        </div>

                        <!-- Legal Services Grid -->
                        <div class="row mt-5">
                            <div class="col-md-4 mb-4">
                                <div class="legal-card p-4 border rounded text-center transition-y h-100 shadow-sm">
                                    <div class="icon text-danger h2 mb-3"><i class="fas fa-file-contract"></i></div>
                                    <h6 class="font-weight-bold">Contrat de Production</h6>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="legal-card p-4 border rounded text-center transition-y h-100 shadow-sm">
                                    <div class="icon text-danger h2 mb-3"><i class="fas fa-hand-holding-usd"></i></div>
                                    <h6 class="font-weight-bold">Contrat de Distribution</h6>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="legal-card p-4 border rounded text-center transition-y h-100 shadow-sm">
                                    <div class="icon text-danger h2 mb-3"><i class="fas fa-paint-brush"></i></div>
                                    <h6 class="font-weight-bold">Contrat d'Exposition</h6>
                                </div>
                            </div>
                        </div>

                        <div class="sec-title-two mt-5 mb-4">
                            <h3 class="font-weight-bold">Pourquoi l'Assistance Juridique ?</h3>
                        </div>
                        <ul class="list-style-three">
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-shield-alt text-danger mr-3"></i> Protection de la propriété intellectuelle.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-shield-alt text-danger mr-3"></i> Garantie de paiement des droits d'auteur.</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fas fa-shield-alt text-danger mr-3"></i> Prévention des litiges avec les producteurs et diffuseurs.</li>
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
