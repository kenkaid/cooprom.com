@extends('front.layouts.app')

@section('title', 'Guides d\'Orientation Visa - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/visa.jpeg';
        $title = 'Orientation Visa';
        $breadcumb_table = ['Guides Visa'];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                        <div class="card-header bg-white p-4 border-0">
                            <h4 class="mb-0 font-weight-bold">Guides d'Orientation par Pays</h4>
                            <p class="text-muted small mb-0">Retrouvez toutes les informations nécessaires pour vos
                                formalités de visa.</p>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                @forelse($guides as $guide)
                                    <div class="col-md-6 mb-4">
                                        <div class="guide-card p-4 border rounded shadow-sm h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box mr-3 bg-light p-3 rounded-circle text-orange">
                                                    <i class="fa fa-map-marked-alt fa-2x"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 font-weight-bold">{{ $guide->country }}</h5>
                                                    <span
                                                        class="badge badge-light text-secondary">{{ $guide->visa_type ?? 'Tous visas' }}</span>
                                                </div>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                {{ Str::limit($guide->description, 100) }}
                                            </p>
                                            <a href="{{ route('member.travels.guide_show', $guide->uuid) }}"
                                               class="btn btn-sm btn-outline-orange rounded-pill px-4">
                                                Consulter le guide
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <i class="fa fa-info-circle fa-3x text-light mb-3"></i>
                                        <h5 class="text-muted">Aucun guide disponible pour le moment.</h5>
                                    </div>
                                @endforelse
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

        .text_orange {
            color: #fa584d !important;
        }

        .text-orange {
            color: #fa584d !important;
        }

        .btn-outline-orange {
            color: #fa584d;
            border-color: #fa584d;
        }

        .btn-outline-orange:hover {
            background-color: #fa584d;
            color: #fff;
        }

        .guide-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent !important;
        }

        .guide-card:hover {
            transform: translateY(-5px);
            border-left-color: #fa584d !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }
    </style>
@endsection
