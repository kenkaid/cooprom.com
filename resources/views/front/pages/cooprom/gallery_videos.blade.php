@extends('front.layouts.app')

@section('title', 'Gallérie Vidéos - COOPROM')

@section('content')
    <!--Page Title-->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/12.jpg') }});">
        <div class="auto-container">
            <h1>Gallérie Vidéos</h1>
            <span class="title_divider"></span>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>La Cooprom</li>
                <li>Gallérie Vidéos</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Portfolio Section -->
    <section class="portfolio-section portfolio-three-col">
        <div class="auto-container">
            <div class="row">
                @forelse($videos as $video)
                    <!-- Portfolio Block Three (Video) -->
                    <div class="portfolio-block-three col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ $video->external_url }}" class="lightbox-image" data-fancybox="gallery">
                                        <div class="video-overlay">
                                            <span class="fa fa-play-circle"></span>
                                        </div>
                                        @if($video->type == 'youtube')
                                            @php
                                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->external_url, $matches);
                                                $youtubeId = $matches[1] ?? null;
                                            @endphp
                                            @if($youtubeId)
                                                <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" alt="{{ $video->title }}" class="portfolio_image">
                                            @else
                                                <div class="placeholder-video bg-dark text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                                                    <i class="fa fa-youtube fa-4x"></i>
                                                </div>
                                            @endif
                                        @else
                                             <div class="placeholder-video bg-dark text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                                                <i class="fa fa-{{ $video->type == 'vimeo' ? 'vimeo' : 'facebook' }} fa-4x"></i>
                                            </div>
                                        @endif
                                    </a>
                                </figure>
                            </div>
                            <div class="lower-content">
                                <h4><a href="javascript:;">{{ $video->title }}</a></h4>
                                @if($video->description)
                                    <p>{{ Str::limit($video->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h3>Aucune vidéo disponible pour le moment.</h3>
                    </div>
                @endforelse
            </div>

            <!-- Styled Pagination -->
            <div class="styled-pagination text-center">
                {{ $videos->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->
@endsection

@section('extra_css')
<style>
    .portfolio_image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: all 0.3s ease;
        display: block;
    }
    .portfolio-block-three .inner-box {
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }
    .portfolio-block-three .image-box {
        position: relative;
        overflow: hidden;
        background: #000;
    }
    .portfolio-block-three .image-box .image {
        margin: 0;
    }
    .portfolio-block-three .inner-box:hover .portfolio_image {
        transform: scale(1.05);
    }
    .portfolio-block-three .lower-content {
        padding: 20px;
    }
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.3);
        z-index: 1;
        pointer-events: none;
    }
    .video-overlay span {
        font-size: 60px;
        color: #fff;
        opacity: 0.8;
        transition: all 0.3s ease;
    }
    .portfolio-block-three .inner-box:hover .video-overlay span {
        transform: scale(1.2);
        opacity: 1;
    }
</style>
@endsection

