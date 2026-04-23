@extends('front.layouts.app')

@section('title', 'Missions & Objectifs - COOPROM | Notre Vision Stratégique')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Missions & Objectifs</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>La Cooprom</li>
                    <li>Missions & Objectifs</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Missions Detail Section -->
    <section class="missions-detail-section py-5">
        <div class="auto-container py-4">
            <div class="sec-title-two text-center mb-5">
                <span class="title">NOTRE RAISON D'ÊTRE</span>
                <h2 class="font-weight-bold">Apporter une <span class="text-danger">valeur ajoutée</span> à l'art africain</h2>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="mission-box p-5 bg-white shadow rounded h-100 border-left border-danger border-lg">
                        <h4 class="font-weight-bold mb-4"><i class="fas fa-bullseye text-danger mr-2"></i> Notre Mission Globale</h4>
                        <p class="text-justify" style="line-height: 1.8;">La COOPROM a pour mission d’apporter dans le domaine de l’art et la culture ivoirienne en particulier et celui de l’Afrique en général, une valeur ajoutée. En d’autres termes faire connaitre le terroir ivoirien ou la culture ivoirienne hors de ces frontières du fait de l’organisation des événements culturels et la participation aux festivals à travers les pays du monde.</p>
                        <p class="text-justify" style="line-height: 1.8;">En plus de cela sa mission est aussi d’aider l’artiste africain dans sa méthode de travail afin d‘améliorer les insuffisances dans son environnement de travail.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="mission-box p-5 bg-dark text-white shadow rounded h-100">
                        <h4 class="font-weight-bold mb-4 text-white"><i class="fas fa-rocket text-danger mr-2"></i> Actions Objectives</h4>
                        <ul class="list-style-three text-white">
                            <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-danger mt-1 mr-3"></i> <span class="text-white">Améliorer les techniques de promotion et de production des artistes.</span></li>
                            <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-danger mt-1 mr-3"></i> <span class="text-white">Favoriser le processus de renforcement des capacités des professionnels de l’art.</span></li>
                            <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-danger mt-1 mr-3"></i> <span class="text-white">Rechercher de la Culture dynamique pour soutenir le progrès technologique.</span></li>
                            <li class="mb-3 d-flex align-items-start"><i class="fas fa-check-circle text-danger mt-1 mr-3"></i> <span class="text-white">Déployer des représentations mondiales pour valoriser l'art africain.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specific Objectives (Grid) -->
    <section class="objectives-section bg-light py-5">
        <div class="auto-container">
            <div class="sec-title-two text-center mb-5">
                <span class="title">OBJECTIFS SPÉCIFIQUES</span>
                <h3 class="font-weight-bold">Nos engagements concrets</h3>
            </div>
            <div class="row">
                @php
                    $objectives = [
                        ['icon' => 'fas fa-film', 'title' => 'Production & Promotion', 'text' => 'La production et la promotion artistique et culturelle de haut niveau.'],
                        ['icon' => 'fas fa-broadcast-tower', 'title' => 'Diffusion des Œuvres', 'text' => 'Assurer une large diffusion des œuvres culturelles sur tous les supports.'],
                        ['icon' => 'fas fa-briefcase', 'title' => 'Voyages d\'Affaires', 'text' => 'Organisation, participation et assistance des voyages d\'affaires dans le monde.'],
                        ['icon' => 'fas fa-mask', 'title' => 'Valorisation Folklore', 'text' => 'La promotion et la valorisation des danses folkloriques et traditionnelles.'],
                        ['icon' => 'fas fa-handshake', 'title' => 'Pôles de Contacts', 'text' => 'Création de pôles de contacts dans toutes les ambassades de Côte d’Ivoire.'],
                        ['icon' => 'fas fa-exchange-alt', 'title' => 'Plateforme d’Échange', 'text' => 'Création d’une plateforme d’échange entre les artistes de différents horizons.'],
                    ];
                @endphp

                @foreach($objectives as $obj)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="objective-card p-4 bg-white shadow-sm rounded text-center transition-y border-top border-danger">
                        <div class="icon text-danger h1 mb-3"><i class="{{ $obj['icon'] }}"></i></div>
                        <h5 class="font-weight-bold mb-2">{{ $obj['title'] }}</h5>
                        <p class="small mb-0 text-muted">{{ $obj['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .transition-y:hover { transform: translateY(-10px); transition: 0.3s; }
    .border-lg { border-left-width: 8px !important; }
    .list-style-three { list-style: none; padding-left: 0; }
</style>
@endsection
