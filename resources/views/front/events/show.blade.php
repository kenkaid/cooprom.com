@extends('front.layouts.app')

@section('title', $event->title . ' - COOPROM')

@section('content')
    <!-- Event Banner -->
    <section class="event-details-banner position-relative overflow-hidden" style="height: 500px;">
        @if($event->image)
            <div class="banner-bg position-absolute w-100 h-100" style="background: url({{ asset('storage/' . $event->image) }}) center/cover fixed;"></div>
        @else
            <div class="banner-bg position-absolute w-100 h-100 bg-dark opacity-75"></div>
        @endif
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.8));"></div>

        <div class="auto-container h-100 d-flex align-items-end pb-5">
            <div class="banner-content text-white position-relative z-index-1">
                <div class="mb-3">
                    <span class="badge bg-danger px-3 py-2 text-uppercase font-weight-bold">{{ $event->type }}</span>
                </div>
                <h1 class="display-4 font-weight-bold mb-3">{{ $event->title }}</h1>
                <div class="event-quick-info d-flex flex-wrap align-items-center h5 mb-0">
                    <span class="mr-4 mb-2"><i class="fas fa-calendar-alt text-danger mr-2"></i> {{ $event->start_date->translatedFormat('d F Y') }}</span>
                    <span class="mr-4 mb-2"><i class="fas fa-map-marker-alt text-danger mr-2"></i> {{ $event->location }}</span>
                    <span class="mb-2"><i class="fas fa-users text-danger mr-2"></i> {{ $event->max_participants ? $event->max_participants . ' places' : 'Accès libre' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Details Content -->
    <section class="event-details-section py-5">
        <div class="auto-container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="content-box pr-lg-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Navigation Tabs -->
                        <ul class="nav nav-tabs creative-tabs mb-4 border-0" id="eventTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ !$isRegistered ? 'active' : '' }}" id="about-tab" data-toggle="tab" href="#about" role="tab">Présentation</a>
                            </li>
                            @if($event->status == 'open_registration')
                            <li class="nav-item">
                                <a class="nav-link {{ $isRegistered ? 'active' : '' }}" id="register-tab" data-toggle="tab" href="#register" role="tab">Inscription</a>
                            </li>
                            @endif
                        </ul>

                        <div class="tab-content" id="eventTabContent">
                            <!-- About Tab -->
                            <div class="tab-pane fade {{ !$isRegistered ? 'show active' : '' }}" id="about" role="tabpanel">
                                <div class="text-content mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                                    {!! nl2br(e($event->description)) !!}
                                </div>

                                <!-- Partner Logos Placeholder -->
                                <div class="partners-box border-top pt-5">
                                    <h5 class="mb-4 font-weight-bold text-uppercase">Partenaires de l'événement</h5>
                                    <div class="row opacity-50">
                                        <div class="col-3 col-md-2 mb-3"><img src="{{ asset('assets/front/images/clients/1.png') }}" class="img-fluid" alt=""></div>
                                        <div class="col-3 col-md-2 mb-3"><img src="{{ asset('assets/front/images/clients/2.png') }}" class="img-fluid" alt=""></div>
                                        <div class="col-3 col-md-2 mb-3"><img src="{{ asset('assets/front/images/clients/3.png') }}" class="img-fluid" alt=""></div>
                                        <div class="col-3 col-md-2 mb-3"><img src="{{ asset('assets/front/images/clients/4.png') }}" class="img-fluid" alt=""></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Register Tab -->
                            <div class="tab-pane fade {{ $isRegistered ? 'show active' : '' }}" id="register" role="tabpanel">
                                @php
                                    $config = [
                                        'pending' => [
                                            'color' => 'warning',
                                            'icon' => 'fa-clock',
                                            'title' => 'Inscription en attente',
                                            'message' => 'Votre demande est en cours de traitement par l\'équipe COOPROM.'
                                        ],
                                        'confirmed' => [
                                            'color' => 'success',
                                            'icon' => 'fa-check-circle',
                                            'title' => 'Inscription validée !',
                                            'message' => 'Félicitations, votre participation à cet événement a été confirmée.'
                                        ],
                                        'cancelled' => [
                                            'color' => 'danger',
                                            'icon' => 'fa-times-circle',
                                            'title' => 'Inscription annulée',
                                            'message' => 'Votre demande d\'inscription a été annulée ou refusée.'
                                        ],
                                    ];
                                    $current = $config[$registrationStatus] ?? $config['pending'];
                                @endphp

                                <div class="registration-card bg-light p-4 rounded border-left border-{{ $current['color'] }} border-width-5 shadow-sm">
                                    @if($isRegistered)
                                        <div class="text-center py-3">
                                            <i class="fas {{ $current['icon'] }} fa-4x text-{{ $current['color'] }} mb-3"></i>
                                            <h4 class="font-weight-bold text-{{ $current['color'] }}">{{ $current['title'] }}</h4>
                                            <p class="mb-0 text-muted">{{ $current['message'] }}</p>

                                            @if($registrationStatus === 'confirmed')
                                                <div class="mt-4">
                                                    <a href="{{ route('events.download-pass', $event->slug) }}" class="btn btn-success btn-lg px-4 shadow-sm">
                                                        <i class="fas fa-id-badge mr-2"></i> Télécharger mon pass (PDF)
                                                    </a>
                                                </div>
                                            @elseif($registrationStatus === 'cancelled')
                                                <div class="mt-3">
                                                    <p class="small">Contactez l'administration pour plus d'informations.</p>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <h4 class="mb-3 font-weight-bold">Rejoignez cet événement</h4>
                                        <p class="mb-4 text-muted">Les inscriptions sont actuellement ouvertes. En tant que membre de la COOPROM, vous bénéficiez de conditions privilégiées.</p>

                                        @auth
                                            <form action="{{ route('events.register', $event->slug) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="font-weight-bold small">Notes / Questions (Optionnel)</label>
                                                        <textarea name="notes" class="form-control" rows="3" placeholder="Avez-vous des besoins spécifiques pour cet événement ?"></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="theme-btn btn-style-one w-100">
                                                            <span class="btn-title">Confirmer ma participation</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="alert alert-info">
                                                Veuillez vous <a href="{{ route('login') }}" class="font-weight-bold text-danger">connecter</a> pour vous inscrire à cet événement.
                                            </div>
                                        @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <aside class="event-sidebar">
                        <!-- Action Card -->
                        <div class="card shadow border-0 mb-4 overflow-hidden rounded-lg">
                            <div class="card-body p-0">
                                <div class="bg-danger text-white p-4 text-center">
                                    <h6 class="text-uppercase mb-2">Participation</h6>
                                    @if($event->entry_fee > 0)
                                        <h2 class="font-weight-bold mb-0">{{ number_format($event->entry_fee, 0, ',', ' ') }} <small>CFA</small></h2>
                                    @else
                                        <h2 class="font-weight-bold mb-0">GRATUIT</h2>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                            <span class="text-muted"><i class="fas fa-clock mr-2"></i> Date</span>
                                            <span class="font-weight-bold text-dark">{{ $event->start_date->format('d/m/Y') }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                            <span class="text-muted"><i class="fas fa-hourglass-start mr-2"></i> Heure</span>
                                            <span class="font-weight-bold text-dark">{{ $event->start_date->format('H:i') }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                            <span class="text-muted"><i class="fas fa-users mr-2"></i> Capacité</span>
                                            <span class="font-weight-bold text-dark">{{ $event->max_participants ?: 'Illimitée' }}</span>
                                        </li>
                                        @if($event->max_participants)
                                        <li class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                            <span class="text-muted"><i class="fas fa-chair mr-2"></i> Places restantes</span>
                                            <span class="badge {{ $event->remaining_places > 5 ? 'bg-success' : 'bg-danger' }} text-white font-weight-bold">{{ $event->remaining_places }}</span>
                                        </li>
                                        @endif
                                    </ul>

                                    @if($event->status == 'open_registration' && !$event->isFull())
                                        <button class="theme-btn btn-style-one w-100 mb-3" onclick="$('#register-tab').tab('show')">
                                            <span class="btn-title"><i class="fas fa-user-plus mr-2"></i> M'inscrire maintenant</span>
                                        </button>
                                    @elseif($event->isFull())
                                        <button class="btn btn-secondary w-100 mb-3" disabled>
                                            <i class="fas fa-ban mr-2"></i> Événement Complet
                                        </button>
                                    @endif

                                    <div class="share-box text-center">
                                        <p class="small text-muted mb-2">Partager cet événement</p>
                                        <div class="social-links">
                                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle mr-2"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle mr-2"><i class="fab fa-whatsapp"></i></a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-twitter"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical File Box -->
                        @if($event->technical_file)
                        <div class="card bg-dark text-white border-0 shadow rounded-lg mb-4">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="icon-box mr-3">
                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 font-weight-bold">Dossier Technique</h6>
                                    <a href="{{ asset('storage/' . $event->technical_file) }}" target="_blank" class="text-danger small">Télécharger (PDF) <i class="fas fa-external-link-alt ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Map Placeholder -->
                        <div class="map-box rounded-lg overflow-hidden shadow mb-4" style="height: 250px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127125.4385338148!2d-4.0496825!3d5.3484439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ea5311959121%3A0x3a70ba4906f3b063!2sAbidjan!5e0!3m2!1sfr!2sci!4v1650000000000!5m2!1sfr!2sci" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .creative-tabs .nav-link {
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        padding: 10px 25px;
        position: relative;
        transition: 0.3s;
    }
    .creative-tabs .nav-link.active {
        color: #ff3c36;
        background: transparent;
    }
    .creative-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #ff3c36;
        border-radius: 3px;
    }
    .border-width-5 {
        border-width: 5px !important;
    }
    .z-index-1 { z-index: 1; }
</style>
@endsection
