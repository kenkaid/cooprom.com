@extends('front.layouts.app')

@section('title', 'Guide Visa : ' . $guide->country . ' - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/visa.jpeg';
        $title = 'Guide Visa : '. $guide->country ;
        $breadcumb_table = [
               'member.travels.guides' => 'Guides Visa',
               '' => $guide->country
               ];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                        <div
                            class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 font-weight-bold">Formalités pour : {{ $guide->country }}</h4>
                                <span
                                    class="badge badge-light text-secondary">{{ $guide->visa_type ?? 'Tous visas' }}</span>
                            </div>
                            <a href="{{ route('member.travels.guides') }}"
                               class="btn btn-sm btn-light rounded-pill px-3">
                                <i class="fa fa-arrow-left mr-1"></i> Retour
                            </a>
                        </div>
                        <div class="card-body p-4">
                            @if($guide->description)
                                <div class="description-box mb-4 p-3 bg-light rounded">
                                    <h6 class="font-weight-bold text-orange mb-2"><i class="fa fa-info-circle mr-2"></i>Introduction
                                    </h6>
                                    <p class="mb-0">{{ $guide->description }}</p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="info-block h-100 p-4 border rounded shadow-sm bg-white">
                                        <h6 class="font-weight-bold text-orange mb-3"><i
                                                class="fa fa-file-alt mr-2"></i>Documents requis</h6>
                                        <div class="content-list small">
                                            {!! nl2br(e($guide->required_documents)) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="info-block h-100 p-4 border rounded shadow-sm bg-white">
                                        <h6 class="font-weight-bold text-orange mb-3"><i class="fa fa-tasks mr-2"></i>Procédure
                                            à suivre</h6>
                                        <div class="content-list small">
                                            {!! nl2br(e($guide->procedure_steps)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($guide->useful_links)
                                <div class="links-box mt-2 p-3 border rounded bg-light">
                                    <h6 class="font-weight-bold mb-2"><i class="fa fa-link mr-2 text-primary"></i>Liens
                                        utiles</h6>
                                    <div class="small text-primary text-break">
                                        {!! nl2br(e($guide->useful_links)) !!}
                                    </div>
                                </div>
                            @endif

                            <div class="mt-5 p-4 bg_orange text-white rounded shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="font-weight-bold mb-1">Besoin d'un accompagnement personnalisé ?</h5>
                                        <p class="mb-0 small">Nos conseillers vous aident dans la constitution de votre
                                            dossier.</p>
                                    </div>
                                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                        <a href="{{ route('member.travels.create_visa', ['country' => $guide->country]) }}"
                                           class="btn btn-light rounded-pill px-4 font-weight-bold text-orange">
                                            Faire une demande
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
    <style>
        .rounded-lg {
            border-radius: 15px !important;
        }

        .text-orange {
            color: #fa584d !important;
        }

        .bg_orange {
            background-color: #fa584d !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .content-list {
            line-height: 1.6;
            color: #555;
        }

        .info-block {
            border-top: 3px solid #fa584d !important;
        }
    </style>
@endsection
