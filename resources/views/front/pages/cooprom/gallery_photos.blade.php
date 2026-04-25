@extends('front.layouts.app')

@section('title', 'Exposition Photo - COOPROM | L\'Art en Image')

@section('content')
    <!-- Exhibition Hero -->
    <section class="gallery-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="height: 50vh; background: #000;">
        <div class="hero-bg position-absolute w-100 h-100" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover fixed; opacity: 0.4;"></div>
        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, transparent, #000);"></div>

        <div class="auto-container position-relative z-index-1 text-center animate-up">
            <span class="d-block h5 text-danger font-weight-bold text-uppercase mb-3 tracking-widest">Exposition Virtuelle</span>
            <h1 class="display-3 font-weight-bold mb-0">Gallérie <span class="text-transparent-stroke-white">Photos</span></h1>
            <div class="divider mx-auto bg-danger mt-4" style="width: 60px; height: 4px;"></div>
        </div>
    </section>

    <!-- Photo Exhibition Grid -->
    <section class="py-5 bg-white">
        <div class="auto-container py-5">
            <div class="row g-4" id="lightgallery">
                @forelse($photos as $index => $photo)
                    @php
                        $media = $photo->getFirstMedia('library');
                    @endphp
                    @if($media)
                        <div class="col-lg-4 col-md-6 mb-4 animate-up" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="art-photo-card position-relative overflow-hidden rounded-xl group cursor-pointer shadow-lg border border-light">
                                <a href="{{ $media->getUrl() }}" class="lightbox-image d-block" data-fancybox="gallery" data-caption="{{ $photo->title }}">
                                    <img src="{{ $media->getUrl('thumb') }}" alt="{{ $photo->title }}" class="img-fluid w-100 transition-all duration-700 group-hover-scale" style="height: 350px; object-fit: cover;" onerror="this.src='{{ $media->getUrl() }}';">

                                    <!-- Elegant Dark Gradient Overlay (Subtle) -->
                                    <div class="photo-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-end p-4 transition-all duration-500 opacity-0 group-hover-opacity-100" style="bottom: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%);">
                                        <h4 class="text-white font-weight-bold mb-1">{{ $photo->title }}</h4>
                                        @if($photo->description)
                                            <p class="text-white-50 small mb-0">{{ Str::limit($photo->description, 60) }}</p>
                                        @endif
                                        <div class="zoom-icon text-white mt-3">
                                            <i class="fas fa-search-plus fa-2x"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="fas fa-camera-retro fa-4x mb-4 opacity-20"></i>
                        <h3>L'exposition est en cours de préparation.</h3>
                    </div>
                @endforelse
            </div>

            <!-- Styled Pagination -->
            <div class="styled-pagination text-center mt-5">
                {{ $photos->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    <!-- Bottom Sticky Nav -->
    <div class="service-nav-sticky bg-white shadow-lg border-top py-3">
        <div class="auto-container">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <a href="{{ route('cooprom.gallery_photos') }}" class="btn btn-link text-danger font-weight-bold px-3 border-bottom border-danger">Photos</a>
                <a href="{{ route('cooprom.gallery_videos') }}" class="btn btn-link text-muted px-3">Vidéos</a>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .bg-white { background-color: #ffffff; }
    .z-index-1 { z-index: 1; }
    .tracking-widest { letter-spacing: 0.5em; }
    .rounded-xl { border-radius: 15px !important; }
    .shadow-lg { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important; }

    .text-transparent-stroke-white {
        -webkit-text-stroke: 1px white;
        color: transparent;
    }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

    .group-hover-scale { transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .art-photo-card:hover .group-hover-scale { transform: scale(1.1); }

    .photo-overlay { transform: translateY(10px); }
    .art-photo-card:hover .photo-overlay { transform: translateY(0); opacity: 1 !important; }

    .duration-700 { transition-duration: 700ms; }

    .service-nav-sticky { position: sticky; bottom: 0; z-index: 100; }
</style>
@endsection

