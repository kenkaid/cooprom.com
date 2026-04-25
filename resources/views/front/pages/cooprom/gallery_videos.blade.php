@extends('front.layouts.app')

@section('title', 'Cinéma & Vidéos - COOPROM | Le Talent en Mouvement')

@section('content')
    <!-- Cinema Hero Section -->
    <section class="video-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 60vh; background: #000;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed; opacity: 0.3;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: radial-gradient(circle, transparent 0%, #000 100%);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <h5 class="text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Projection Exclusive</h5>
            <h1 class="display-3 font-weight-bold mb-4">Gallérie <span class="text-transparent-stroke-white">Vidéos</span></h1>
            <div class="play-icon-decoration animate-pulse">
                <i class="fas fa-play-circle fa-4x text-danger opacity-50"></i>
            </div>
        </div>
    </section>

    <!-- Video Showcase Grid -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5">
            <div class="row g-4">
                @forelse($videos as $index => $video)
                    <div class="col-lg-6 col-md-12 mb-5 animate-up" style="animation-delay: {{ $index * 0.2 }}s;">
                        <div class="video-card-cinema position-relative overflow-hidden rounded-3xl shadow-lg border border-light group">
                            <!-- Video Thumbnail Box -->
                            <div class="thumbnail-wrapper position-relative">
                                @if($video->type == 'youtube')
                                    @php
                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->external_url, $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp
                                    @if($youtubeId)
                                        <img src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg" alt="{{ $video->title }}" class="img-fluid w-100 transition-all duration-700 group-hover-scale" style="height: 350px; object-fit: cover;" onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg';">
                                    @else
                                        <div class="placeholder-video bg-light d-flex align-items-center justify-content-center" style="height: 350px;">
                                            <i class="fab fa-youtube fa-5x text-danger opacity-20"></i>
                                        </div>
                                    @endif
                                @else
                                    <div class="placeholder-video bg-light d-flex align-items-center justify-content-center" style="height: 350px;">
                                        <i class="fas fa-film fa-5x text-danger opacity-20"></i>
                                    </div>
                                @endif

                                <!-- Subtle Play Overlay -->
                                <div class="play-button-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="top:0; left:0; background: rgba(0,0,0,0.1);">
                                    <a href="{{ $video->external_url }}" class="lightbox-image glass-play-btn shadow-lg" data-fancybox="gallery">
                                        <i class="fas fa-play text-white fa-lg"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Content Info -->
                            <div class="video-content-info p-4 bg-white border-top border-light">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h3 class="h4 text-dark font-weight-bold mb-1">{{ $video->title }}</h3>
                                        @if($video->description)
                                            <p class="text-muted small mb-0">{{ Str::limit($video->description, 80) }}</p>
                                        @endif
                                    </div>
                                    <span class="badge bg-danger rounded-pill px-3">{{ strtoupper($video->type) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="fas fa-video-slash fa-4x mb-4 opacity-20"></i>
                        <h3>Aucune production disponible pour le moment.</h3>
                    </div>
                @endforelse
            </div>

            <!-- Styled Pagination -->
            <div class="styled-pagination text-center mt-5">
                {{ $videos->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('cooprom.gallery_photos') }}" class="btn btn-link text-muted px-3">Photos</a>
                <a href="{{ route('cooprom.gallery_videos') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Vidéos</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .bg-white { background-color: #ffffff; }
    .z-index-1 { z-index: 1; }
    .tracking-widest { letter-spacing: 0.5em; }
    .rounded-3xl { border-radius: 30px !important; }
    .shadow-lg { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important; }

    .text-transparent-stroke-white {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    .animate-pulse { animation: pulse 3s infinite; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0% { transform: scale(1); opacity: 0.5; } 50% { transform: scale(1.1); opacity: 0.8; } 100% { transform: scale(1); opacity: 0.5; } }

    .group-hover-scale { transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .video-card-cinema:hover .group-hover-scale { transform: scale(1.05); }

    .glass-play-btn {
        width: 70px;
        height: 70px;
        background: #ff3c36;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        box-shadow: 0 10px 20px rgba(255, 60, 54, 0.3);
    }
    .glass-play-btn:hover {
        transform: scale(1.2);
        background: #e62e26;
    }

    .duration-700 { transition-duration: 700ms; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection

