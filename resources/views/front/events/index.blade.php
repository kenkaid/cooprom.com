@extends('front.layouts.app')

@section('title', 'Agenda Culturel - COOPROM | Festivals & Spectacles')

@section('content')
    <!-- Creative Banner Title Section -->
    <section class="creative-banner-section position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 50vh; min-height: 400px; background: #000;">
        <div class="banner-bg-wrapper position-absolute w-100 h-100">
            <div class="banner-img position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/cultural_agenda.jpeg') }}) center/cover fixed; opacity: 0.5;"></div>
            <div class="overlay position-absolute w-100 h-100" style="background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>
        </div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <div class="pre-title mb-3">
                <span class="badge bg-danger px-3 py-2 text-uppercase tracking-widest font-weight-bold shadow-lg" style="letter-spacing: 3px;">Expérience Culturelle</span>
            </div>
            <h1 class="display-2 font-weight-bold mb-4 line-height-1">Agenda <span class="text-transparent-stroke-white">Vibrant</span></h1>
            <p class="lead text-white mb-5 max-width-600 mx-auto font-italic" style="opacity: 0.9;">"Là où le talent rencontre l'opportunité mondiale."</p>

            <nav aria-label="breadcrumb" class="mt-5">
                <ol class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-white opacity-50 hover-opacity-100">Accueil</a></li>
                    <li class="breadcrumb-item active text-danger font-weight-bold" aria-current="page">Nos Événements</li>
                </ol>
            </nav>
        </div>

        <!-- Decoration Scrolling Line -->
        <div class="position-absolute w-100 py-2 bg-danger" style="bottom: 0; left: 0; transform: skewY(-1deg); opacity: 0.8; z-index: 2;"></div>
    </section>

    <!-- Events Section -->
    <section class="events-section py-5 bg-light">
        <div class="auto-container">

            <!-- Filter Bar -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="events-filter-bar bg-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center flex-wrap">
                        <div class="filter-title mb-2 mb-md-0">
                            <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-filter text-danger mr-2"></i>Filtrer par type</h5>
                        </div>
                        <div class="filter-buttons">
                            <a href="{{ route('events.index') }}" class="btn btn-sm {{ !request('type') ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 mb-2">Tous</a>
                            <a href="{{ route('events.index', ['type' => 'festival']) }}" class="btn btn-sm {{ request('type') == 'festival' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 mb-2">Festivals</a>
                            <a href="{{ route('events.index', ['type' => 'exposition']) }}" class="btn btn-sm {{ request('type') == 'exposition' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 mb-2">Expositions</a>
                            <a href="{{ route('events.index', ['type' => 'spectacle']) }}" class="btn btn-sm {{ request('type') == 'spectacle' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 mb-2">Spectacles</a>
                            <a href="{{ route('events.index', ['type' => 'seminaire']) }}" class="btn btn-sm {{ request('type') == 'seminaire' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 mb-2">Séminaires</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="event-card-creative h-100 bg-white rounded-lg overflow-hidden shadow-sm transition-all position-relative">
                            <!-- Image Box -->
                            <div class="event-image position-relative">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center w-100" style="height: 250px;">
                                        <i class="fas fa-calendar-alt text-white fa-4x opacity-50"></i>
                                    </div>
                                @endif

                                <!-- Status Badge Overlay -->
                                <div class="status-overlay position-absolute" style="top: 15px; left: 15px;">
                                    @php
                                        $statusLabels = [
                                            'published' => 'À Venir',
                                            'open_registration' => 'Inscriptions Ouvertes',
                                            'ongoing' => 'En cours',
                                            'completed' => 'Terminé',
                                            'cancelled' => 'Annulé',
                                        ];
                                        $statusColors = [
                                            'published' => 'bg-info',
                                            'open_registration' => 'bg-success',
                                            'ongoing' => 'bg-warning',
                                            'completed' => 'bg-secondary',
                                            'cancelled' => 'bg-danger',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusColors[$event->status] ?? 'bg-dark' }} text-white px-3 py-2 rounded-pill shadow">
                                        {{ $statusLabels[$event->status] ?? $event->status }}
                                    </span>
                                </div>

                                <!-- Date Box Overlay -->
                                <div class="date-box-overlay position-absolute" style="bottom: -20px; right: 20px;">
                                    <div class="bg-danger text-white text-center p-2 rounded shadow" style="min-width: 60px;">
                                        <span class="d-block h4 mb-0 font-weight-bold">{{ $event->start_date->format('d') }}</span>
                                        <span class="d-block small text-uppercase">{{ $event->start_date->translatedFormat('M') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Box -->
                            <div class="event-content p-4 pt-5">
                                <div class="event-meta mb-2 small text-muted">
                                    <span class="mr-3"><i class="fas fa-tag text-danger mr-1"></i> {{ ucfirst($event->type) }}</span>
                                    <span><i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ Str::limit($event->location ?? 'N/A', 25) }}</span>
                                </div>
                                <h4 class="event-title mb-3 font-weight-bold">
                                    <a href="{{ route('events.show', $event->slug) }}" class="text-dark hover-text-danger">{{ $event->title }}</a>
                                </h4>

                                @if($event->max_participants)
                                    <div class="availability-bar mb-3">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Disponibilité</span>
                                            <span class="font-weight-bold {{ $event->remaining_places <= 5 ? 'text-danger' : 'text-success' }}">
                                                {{ $event->remaining_places }} places libres
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            @php
                                                $used = $event->max_participants - $event->remaining_places;
                                                $percent = ($used / $event->max_participants) * 100;
                                            @endphp
                                            <div class="progress-bar {{ $percent > 80 ? 'bg-danger' : 'bg-success' }}" style="width: {{ $percent }}%"></div>
                                        </div>
                                    </div>
                                @endif

                                <p class="text-muted small mb-4">
                                    {{ Str::limit(strip_tags($event->description), 120) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                                    <div class="price-info">
                                        @if($event->entry_fee > 0)
                                            <span class="h5 mb-0 font-weight-bold text-danger">{{ number_format($event->entry_fee, 0, ',', ' ') }}</span> <small class="text-muted">CFA</small>
                                        @else
                                            <span class="h5 mb-0 font-weight-bold text-success">GRATUIT</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('events.show', $event->slug) }}" class="theme-btn btn-style-one py-2 px-3 small">
                                        <span class="btn-title">Détails <i class="fas fa-arrow-right ml-1"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-calendar-times fa-5x text-muted mb-4"></i>
                            <h3 class="text-muted">Aucun événement trouvé</h3>
                            <p>Revenez bientôt pour découvrir nos prochains rendez-vous culturels.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination-box text-center mt-5 mb-5">
                {{ $events->links() }}
            </div>

            @if($pastEvents->count() > 0)
            <!-- Past Events Section -->
            <div class="past-events-section mt-5 pt-5 border-top">
                <div class="sec-title-two mb-4">
                    <span class="title text-muted">HISTORIQUE</span>
                    <h2 class="font-weight-bold">Événements Passés</h2>
                    <p class="text-muted">Retrouvez les moments forts et les succès de la COOPROM.</p>
                </div>

                <div class="row">
                    @foreach($pastEvents as $pastEvent)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="event-card-past bg-white rounded shadow-sm overflow-hidden opacity-75 grayscale-hover transition-all">
                                <div class="position-relative">
                                    @if($pastEvent->image)
                                        <img src="{{ asset('storage/' . $pastEvent->image) }}" alt="" class="img-fluid" style="height: 180px; width: 100%; object-fit: cover; filter: grayscale(100%);">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                            <i class="fas fa-history fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="position-absolute border border-white text-white px-2 py-1 rounded" style="top:10px; right:10px; background: rgba(0,0,0,0.5); font-size: 10px;">
                                        TERMINÉ
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="small text-muted mb-1">{{ $pastEvent->start_date->format('d/m/Y') }}</div>
                                    <h6 class="font-weight-bold mb-2"><a href="{{ route('events.show', $pastEvent->slug) }}" class="text-dark">{{ $pastEvent->title }}</a></h6>
                                    <a href="{{ route('events.show', $pastEvent->slug) }}" class="btn btn-sm btn-link text-danger p-0 font-weight-bold">Voir le récapitulatif <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .grayscale-hover:hover {
        opacity: 1 !important;
    }
    .grayscale-hover:hover img {
        filter: grayscale(0%) !important;
    }
    .event-card-creative {
        border: none;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 15px !important;
    }
    .event-card-creative:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    .hover-text-danger:hover {
        color: #ff3c36 !important;
        text-decoration: none;
    }
    .event-image {
        overflow: hidden;
    }
    .event-image img {
        transition: transform 0.6s ease;
    }
    .event-card-creative:hover .event-image img {
        transform: scale(1.1);
    }
    .event-type-badge {
        background: rgba(255, 60, 54, 0.1);
        color: #ff3c36;
        font-weight: 600;
    }
    .page-title {
        padding: 120px 0 100px;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>
@endsection
