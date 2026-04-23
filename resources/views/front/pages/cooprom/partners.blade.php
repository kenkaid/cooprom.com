@extends('front.layouts.app')

@section('title', 'Partenaires - COOPROM | Notre Réseau International')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Nos Partenaires</h1>
                </div>
                <ul class="page-breadcrumb">
                    <li><a href="/">Accueil</a></li>
                    <li>La Cooprom</li>
                    <li>Partenaires</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Partners Intro Section -->
    <section class="partners-intro py-5">
        <div class="auto-container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sec-title-two">
                        <span class="title">RÉSEAUTAGE GLOBAL</span>
                        <h2 class="font-weight-bold">Un réseau au service du <span class="text-danger">progrès artistique</span></h2>
                    </div>
                    <div class="text text-justify" style="line-height: 1.8;">
                        <p>La COOPROM développe un réseau de partenaires stratégiques en Côte d’Ivoire et à l’étranger afin de favoriser les échanges d’expériences, la co-production, la diffusion et la promotion des œuvres de ses adhérents.</p>
                        <p>Nous collaborons avec des institutions culturelles, des investisseurs du milieu artistique et des professionnels de l'art pour créer des débouchés concrets pour nos artistes.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-box pl-lg-5">
                        <figure class="image rounded shadow-lg"><img src="{{ asset('assets/front/images/resource/image-1.jpg') }}" alt="COOPROM Partners"></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Grid Section (Logos) -->
    <section class="partners-grid-section bg-light py-5">
        <div class="auto-container py-4">
            <div class="sec-title-two text-center mb-5">
                <span class="title">ILS NOUS ACCOMPAGNENT</span>
                <h3 class="font-weight-bold">Nos Partenaires & Alliances</h3>
            </div>

            <div class="row text-center">
                @for ($i = 1; $i <= 6; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="partner-card p-5 bg-white shadow-sm rounded border transition-y d-flex align-items-center justify-content-center" style="height: 150px;">
                        <img src="{{ asset('assets/front/images/clients/'.$i.'.png') }}" alt="Partner Logo {{ $i }}" class="img-fluid opacity-7 grayscale-hover">
                    </div>
                </div>
                @endfor
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="partner-card p-4 bg-white shadow-sm rounded border transition-y d-flex align-items-center justify-content-center text-danger font-weight-bold" style="height: 150px; border-style: dashed !important;">
                        Votre Logo Ici
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg_red text-white py-5">
        <div class="auto-container text-center py-3">
            <h3 class="text-white font-weight-bold mb-4">Vous souhaitez devenir partenaire de la COOPROM ?</h3>
            <p class="mb-5 opacity-8">Ensemble, dynamisons l'action culturelle et artistique pour soutenir le progrès de nos talents.</p>
            <a href="#" class="theme-btn btn-style-one bg-white text-danger px-5 py-3 shadow">
                <span class="btn-title" style="color: #ff3c36;">Contactez-nous</span>
            </a>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .transition-y:hover { transform: translateY(-10px); transition: 0.3s; }
    .opacity-7 { opacity: 0.7; }
    .grayscale-hover { filter: grayscale(100%); transition: 0.3s; }
    .grayscale-hover:hover { filter: grayscale(0%); opacity: 1; }
</style>
@endsection
